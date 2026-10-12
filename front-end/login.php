<?php
session_start();
require_once __DIR__ . '/../back-end/conexao.php';

$erro = '';
$email = '';
$contaExcluida = ($_GET['conta_excluida'] ?? '') === '1';
$cadastroConcluido = ($_GET['cadastro'] ?? '') === 'sucesso';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = (string) ($_POST['senha'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
        $erro = 'Informe um e-mail válido e sua senha.';
    } elseif (!isset($pdo)) {
        $erro = 'Não foi possível conectar ao banco de dados.';
    } else {
        try {
            $stmt = $pdo->prepare('SELECT ID AS id, nome, email, senha FROM usuario WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario && password_verify($senha, (string) ($usuario['senha'] ?? ''))) {
                session_regenerate_id(true);
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['logado'] = true;
                header('Location: perfil.php');
                exit;
            }
            $erro = 'E-mail ou senha incorretos.';
        } catch (PDOException $e) {
            $erro = 'Não foi possível realizar o login. Tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#29251f">
    <title>Entrar | Rafael Lima Fotografia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-page auth-login">
    <main class="auth-card">
        <a class="auth-brand" href="index.php" aria-label="Rafael Lima Fotografia — página inicial"><img src="img/logo.png" alt="Rafael Lima Fotografia"></a>
        <span class="auth-kicker">Área do cliente</span>
        <h1>Bem-vindo de volta</h1>
        <p class="auth-description">Entre para acessar seu perfil e acompanhar seus registros.</p>
        <?php if ($contaExcluida): ?>
            <p class="auth-notice" role="status">Sua conta foi excluída.</p>
        <?php elseif ($cadastroConcluido): ?>
            <p class="auth-notice" role="status">Cadastro concluído. Entre com seu e-mail e senha.</p>
        <?php endif; ?>
        <?php if ($erro !== ''): ?>
            <p class="auth-error" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="auth-field"><label for="email">E-mail</label><input id="email" type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" placeholder="voce@exemplo.com" autocomplete="email" required></div>
            <div class="auth-field"><label for="senha">Senha</label><input id="senha" type="password" name="senha" placeholder="Digite sua senha" autocomplete="current-password" required></div>
            <button class="auth-submit" type="submit">Entrar na minha conta</button>
        </form>
        <p class="auth-switch">Ainda não tem uma conta? <a href="cadastrar.php">Criar cadastro</a></p>
        <a class="auth-home" href="index.php">Voltar para o site</a>
    </main>
</body>
</html>