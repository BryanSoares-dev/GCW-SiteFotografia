<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | Rafael Lima Fotografia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_contato.css">
    <link rel="stylesheet" href="css/site-theme.css">
</head>
<body>
<?php include_once __DIR__ . '/navbar.php'; ?>
<hr style="background-color:black;">
<main>
    <div class="container-contato">
        <div class="total-sessao">
            <a href="https://wa.me/5511962606110" target="_blank" rel="noopener" class="sessao-link">
                <div class="sessao"><img class="icon" src="img/icons/telefone.png" alt="Telefone" height="30" width="30"><section><p class="info">LIGUE PARA MIM</p><p class="info">+55 11 9 6260-6110</p></section></div>
            </a>
            <a href="https://maps.google.com" target="_blank" rel="noopener" class="sessao-link">
                <div class="sessao"><img class="icon" src="img/icons/loc.png" alt="Localização" height="30" width="30"><section><p class="info">LOCALIZAÇÃO</p><p class="info">Rua Fulano de Tal, 123</p></section></div>
            </a>
            <div class="sessao"><img class="icon" src="img/icons/relogio.png" alt="Horário" height="30" width="30"><section><p class="info">HORÁRIO COMERCIAL</p><p class="info">Funcionamento das 11h às 18h</p></section></div>
        </div>
        <div class="caixa-form">
            <h1 class="forms-titulo">Vamos conversar?</h1>
            <form action="contato_enviado.php" method="POST">
                <input class="nome" type="text" name="nome" placeholder="Digite seu nome" minlength="3" maxlength="30" required>
                <input class="email" type="email" name="email" placeholder="Digite seu e-mail" minlength="5" maxlength="50" required>
                <textarea class="descricao" name="mensagem" placeholder="Escreva sua mensagem..." minlength="10" maxlength="500" required></textarea>
                <input class="enviar" type="submit" value="Enviar">
            </form>
        </div>
    </div>
</main>
<hr class="foot4">
<footer>&copy; Projeto desenvolvido por Bryan Soares e Jonatha de Paula</footer>
</body>
</html>