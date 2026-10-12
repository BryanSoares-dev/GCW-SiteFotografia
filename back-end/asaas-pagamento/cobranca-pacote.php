<?php
// Endpoint de cobrança Asaas para os pacotes de fotografia.
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function responder(int $status, array $dados): never
{
    http_response_code($status);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

function configAsaas(string $chave, string $padrao = ''): string
{
    $valor = getenv($chave);
    if ($valor !== false && $valor !== '') return $valor;
    static $env = null;
    if ($env === null) {
        $arquivo = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
        $env = is_file($arquivo) ? (parse_ini_file($arquivo, false, INI_SCANNER_RAW) ?: []) : [];
    }
    return (string) ($env[$chave] ?? $padrao);
}

function asaasRequest(string $metodo, string $caminho, ?array $dados = null): array
{
    $chave = configAsaas('ASAAS_API_KEY');
    $base = rtrim(configAsaas('ASAAS_BASE_URL', 'https://api-sandbox.asaas.com/v3'), '/');
    if ($chave === '') throw new RuntimeException('ASAAS_API_KEY não configurada.');
    if (!function_exists('curl_init')) throw new RuntimeException('A extensão cURL do PHP não está habilitada.');
    $curl = curl_init($base . '/' . ltrim($caminho, '/'));
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => strtoupper($metodo),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'User-Agent: GCW-SiteFotografia/1.0', 'access_token: ' . $chave],
    ]);
    if ($dados !== null) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
    $resposta = curl_exec($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $erroCurl = curl_error($curl);
    curl_close($curl);
    if ($resposta === false) throw new RuntimeException('Falha de conexão com o Asaas: ' . $erroCurl);
    $json = json_decode($resposta, true);
    $json = is_array($json) ? $json : [];
    if ($status < 200 || $status >= 300) {
        error_log("[asaas-pacote] HTTP $status: $resposta");
        throw new RuntimeException('O Asaas recusou a solicitação. Confira os dados e tente novamente.');
    }
    return $json;
}

function cpfValido(string $cpf): bool
{
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) return false;
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) $soma += (int) $cpf[$i] * (($t + 1) - $i);
        $digito = ((10 * $soma) % 11) % 10;
        if ((int) $cpf[$t] !== $digito) return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') responder(405, ['erro' => 'Método não permitido.']);
$token = (string) ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if (empty($_SESSION['csrf_pacotes']) || $token === '' || !hash_equals($_SESSION['csrf_pacotes'], $token)) {
    responder(403, ['erro' => 'Sessão expirada. Atualize a página e tente novamente.']);
}
$entrada = json_decode(file_get_contents('php://input'), true);
if (!is_array($entrada)) responder(400, ['erro' => 'Dados inválidos.']);
$planos = [
    'casamento' => ['nome' => 'Pacote de fotografia - Casamento', 'valor' => 5800.00],
    'evento' => ['nome' => 'Pacote de fotografia - Eventos', 'valor' => 1600.00],
    'ensaio' => ['nome' => 'Pacote de fotografia - Ensaios', 'valor' => 1380.00],
];
$planoId = (string) ($entrada['plano'] ?? '');
$nome = trim((string) ($entrada['nome'] ?? ''));
$email = trim((string) ($entrada['email'] ?? ''));
$telefone = preg_replace('/\D+/', '', (string) ($entrada['telefone'] ?? ''));
$cpf = preg_replace('/\D+/', '', (string) ($entrada['cpf'] ?? ''));
$data = (string) ($entrada['dataFesta'] ?? '');
$dataObj = DateTime::createFromFormat('!Y-m-d', $data);
if (!isset($planos[$planoId])) responder(422, ['erro' => 'Pacote inválido.']);
if ($nome === '' || strlen($nome) > 400 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) responder(422, ['erro' => 'Informe nome e e-mail válidos.']);
if (strlen($telefone) < 10 || strlen($telefone) > 11 || !cpfValido($cpf)) responder(422, ['erro' => 'Informe telefone e CPF válidos.']);
if (!$dataObj || $dataObj->format('Y-m-d') !== $data || $data < date('Y-m-d')) responder(422, ['erro' => 'Informe uma data válida para a festividade.']);

try {
    $cliente = asaasRequest('POST', '/customers', [
        'name' => $nome,
        'email' => $email,
        'cpfCnpj' => $cpf,
        'mobilePhone' => $telefone,
        'externalReference' => bin2hex(random_bytes(16)),
    ]);
    $customerId = (string) ($cliente['id'] ?? '');
    if ($customerId === '') throw new RuntimeException('O Asaas não retornou o ID do cliente.');
    $plano = $planos[$planoId];
    $cobranca = asaasRequest('POST', '/payments', [
        'customer' => $customerId,
        'billingType' => 'PIX',
        'value' => $plano['valor'],
        'dueDate' => date('Y-m-d', strtotime('+3 days')),
        'description' => $plano['nome'] . ' | Data: ' . $data,
        'externalReference' => bin2hex(random_bytes(16)),
    ]);
    $paymentId = (string) ($cobranca['id'] ?? '');
    if ($paymentId === '') throw new RuntimeException('O Asaas não retornou o ID da cobrança.');
    try {
        $qr = asaasRequest('GET', '/payments/' . rawurlencode($paymentId) . '/pixQrCode');
    } catch (Throwable $e) {
        error_log('[asaas-pacote] QR indisponível: ' . $e->getMessage());
        $qr = [];
    }
    responder(200, [
        'ok' => true,
        'valor' => $plano['valor'],
        'invoiceUrl' => $cobranca['invoiceUrl'] ?? null,
        'pixCopiaECola' => $qr['payload'] ?? null,
        'pixImagem' => isset($qr['encodedImage']) ? 'data:image/png;base64,' . $qr['encodedImage'] : null,
    ]);
} catch (Throwable $e) {
    error_log('[asaas-pacote] ' . $e->getMessage());
    responder(502, ['erro' => 'Não foi possível gerar a cobrança Pix. Confira a configuração do Asaas e tente novamente.']);
}