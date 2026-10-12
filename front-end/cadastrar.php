<?php
$erro = '';
if (($_GET['erro'] ?? '') === 'dados_invalidos') $erro = 'Confira seus dados e tente novamente.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#29251f">
    <title>Criar conta | Rafael Lima Fotografia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-page auth-cadastro">
    <main class="auth-card">
        <a class="auth-brand" href="index.php" aria-label="Rafael Lima Fotografia — página inicial"><img src="img/logo.png" alt="Rafael Lima Fotografia"></a>
        <span class="auth-kicker">Um espaço para suas memórias</span>
        <h1>Crie sua conta</h1>
        <p class="auth-description">Cadastre-se para acessar seu perfil e ficar perto dos seus momentos especiais.</p>
        <?php if ($erro !== ''): ?><p class="auth-error" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form action="../back-end/processa_cadastro.php" method="POST">
            <div class="auth-field"><label for="nome">Nome completo</label><input id="nome" type="text" name="nome" placeholder="Como podemos chamar você?" autocomplete="name" minlength="3" maxlength="100" required></div>
            <div class="auth-field"><label for="email">E-mail</label><input id="email" type="email" name="email" placeholder="voce@exemplo.com" autocomplete="email" maxlength="150" required></div>
            <div class="auth-field"><label for="telefone">Telefone</label><input id="telefone" type="tel" name="telefone" placeholder="(00) 00000-0000" autocomplete="tel" maxlength="15" required></div>
            <div class="auth-field"><label for="senha">Senha</label><input id="senha" type="password" name="senha" placeholder="Crie uma senha" autocomplete="new-password" minlength="8" required><small>Use pelo menos 8 caracteres.</small></div>
            <button class="auth-submit" type="submit">Criar minha conta</button>
        </form>
        <p class="auth-switch">Já tem uma conta? <a href="login.php">Entrar</a></p>
        <a class="auth-home" href="index.php">Voltar para o site</a>
    </main>
</body>
</html>