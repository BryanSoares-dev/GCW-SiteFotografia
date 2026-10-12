<?php
session_start();

function voltarPerfilExclusao(string $mensagem): void
{
    $_SESSION['flash_conta'] = $mensagem;
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

$token = (string) ($_POST['csrf_token'] ?? '');
if (empty($_SESSION['csrf_perfil']) || $token === '' || !hash_equals($_SESSION['csrf_perfil'], $token)) {
    voltarPerfilExclusao('Sua sessão expirou. Atualize a página e tente novamente.');
}

$senha = (string) ($_POST['senha_exclusao'] ?? '');
if ($senha === '') {
    voltarPerfilExclusao('Informe sua senha para confirmar a exclusão da conta.');
}

require_once __DIR__ . '/conexao.php';
if (!isset($pdo) || !$pdo instanceof PDO) {
    voltarPerfilExclusao('Não foi possível conectar ao banco de dados. Tente novamente.');
}

try {
    $usuarioId = (int) $_SESSION['id'];
    $consulta = $pdo->prepare('SELECT senha FROM usuario WHERE ID = :id LIMIT 1');
    $consulta->execute([':id' => $usuarioId]);
    $hashSenha = $consulta->fetchColumn();

    if (!is_string($hashSenha) || !password_verify($senha, $hashSenha)) {
        voltarPerfilExclusao('A senha está incorreta. A conta não foi excluída.');
    }

    $remocao = $pdo->prepare('DELETE FROM usuario WHERE ID = :id');
    $remocao->execute([':id' => $usuarioId]);
    if ($remocao->rowCount() !== 1) {
        throw new RuntimeException('A conta não foi removida.');
    }

    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires' => time() - 42000,
            'path' => $params['path'],
            'domain' => $params['domain'],
            'secure' => $params['secure'],
            'httponly' => $params['httponly'],
            'samesite' => $params['samesite'] ?? 'Lax',
        ]);
    }
    session_destroy();
    header('Location: ../front-end/login.php?conta_excluida=1', true, 303);
    exit;
} catch (PDOException | RuntimeException $e) {
    error_log('[excluir_conta] ' . $e->getMessage());
    voltarPerfilExclusao('Não foi possível excluir a conta agora. Tente novamente.');
}
