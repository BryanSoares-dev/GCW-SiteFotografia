<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
$estaLogado    = isset($_SESSION['id']);
$nomeUsuario   = $_SESSION['nome'] ?? 'Usuário';
$avatarUsuario = $_SESSION['avatar'] ?? 'img/avatar-default.png';
?>

<header>
 
    <div class="menu">
 
        <img
            class="logo"
            src="img/logo.png"
            alt="Logo Rafael Lima Fotografia">
 
        <ul>
            <a href="index.php#portifolio"><li>Portfólio</li></a>
            <a href="pacotes.php"><li>Serviços e Pacotes</li></a>
            <a href="sobre.php"><li>Sobre Mim</li></a>
            <a href="contato.php"><li>Contato</li></a>
        </ul>
 
        <div class="container-login">
            <?php if ($estaLogado): ?>
                <a href="perfil.php" class="perfil-link">
                    <img
                        class="avatar-navbar"
                        src="<?php echo htmlspecialchars($avatarUsuario); ?>"
                        alt="Foto de perfil de <?php echo htmlspecialchars($nomeUsuario); ?>">
                    <span class="nome-navbar"><?php echo htmlspecialchars($nomeUsuario); ?></span>
                </a>
            <?php else: ?>
                <a href="cadastrar.php"><button class="login">Registrar</button></a>
                <a href="login.php"><button class="login">Entrar</button></a>
            <?php endif; ?>
        </div>
 
    </div>
 
</header>
