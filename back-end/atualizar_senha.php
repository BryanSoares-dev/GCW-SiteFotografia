<?php
session_start();

function voltarPerfil(string $mensagem, string $tipo = 'erro'): void
{
    $_SESSION['flash_senha'] = ['mensagem' => $mensagem, 'tipo' => $tipo];
    header('Location: ../front-end/perfil.php', true, 303);
    exit;
}

if (empty($_SESSION['id'])) {
    header('Location: ../front-end/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../front-end/perfil.php', true, 303);
    exit;
}

$csrf = (string) ($_POST['csrf_token'] ?? '');
if (empty($_SESSION['csrf_perfil']) || $csrf === '' || !hash_equals($_SESSION['csrf_perfil'], $csrf)) {
    voltarPerfil('Sua sessão expirou. Atualize a página e tente novamente.');
}

$senhaAtual = (string) ($_POST['senha_atual'] ?? '');
$novaSenha = (string) ($_POST['nova_senha'] ?? '');
$confirmarSenha = (string) ($_POST['confirmar_senha'] ?? '');

if ($senhaAtual === '' || $novaSenha === '' || $confirmarSenha === '') {
    voltarPerfil('Preencha todos os campos de senha.');
}
if (strlen($novaSenha) < 8) {
    voltarPerfil('A nova senha deve ter pelo menos 8 caracteres.');
}
if (!hash_equals($novaSenha, $confirmarSenha)) {
    voltarPerfil('A nova senha e a confirmação não coincidem.');
}

require_once __DIR__ . '/conexao.php';
if (!isset($pdo) || !$pdo instanceof PDO) {
    voltarPerfil('Não foi possível conectar ao banco de dados. Tente novamente.');
}

try {
    $consulta = $pdo->prepare('SELECT senha FROM usuario WHERE ID = :id LIMIT 1');
    $consulta->execute([':id' => (int) $_SESSION['id']]);
    $senhaHashAtual = $consulta->fetchColumn();

    if (!is_string($senhaHashAtual) || !password_verify($senhaAtual, $senhaHashAtual)) {
        voltarPerfil('A senha atual está incorreta.');
    }
    if (password_verify($novaSenha, $senhaHashAtual)) {
        voltarPerfil('Escolha uma senha diferente da atual.');
    }

    $novoHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    if ($novoHash === false) {
        throw new RuntimeException('Não foi possível gerar o hash da senha.');
    }

    $atualizacao = $pdo->prepare('UPDATE usuario SET senha = :senha WHERE ID = :id');
    $atualizacao->execute([
        ':senha' => $novoHash,
        ':id' => (int) $_SESSION['id'],
    ]);

    if ($atualizacao->rowCount() !== 1) {
        throw new RuntimeException('A senha não foi atualizada.');
    }

    voltarPerfil('Senha alterada com sucesso.', 'sucesso');
} catch (PDOException | RuntimeException $e) {
    error_log('[atualizar_senha] ' . $e->getMessage());
    voltarPerfil('Não foi possível alterar sua senha agora. Tente novamente.');
}
