<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_contato.css">
</head>

<body>

<header>
    <div class="menu">

        <img class="logo"
             src="img/logo.png"
             alt="logomarca">

        <ul>
                <a href="index.php"><li>Inicio</li></a>
                <a href="portifolio.php"><li>Portfólio</li></a>
                <a href="pacotes.php"><li>Serviços e Pacotes</li></a>
                <a href="sobre.php"><li>Sobre Mim</li></a>
                <a href="contato.php"><li>Contato</li></a>
            </ul>

    </div>
</header>

<hr style="background-color:black;">

<main>

    <div class="container-contato">

        <div class="total-sessao">

            <!-- TELEFONE -->
            <a href="https://wa.me/5511962606110"
               target="_blank"
               class="sessao-link">

                <div class="sessao">

                    <img class="icon"
                         src="img/icons/telefone.png"
                         alt="Telefone"
                         height="30"
                         width="30">

                    <section>

                        <p class="info">LIGUE PARA MIM</p>

                        <p class="info">
                            +55 11 9 6260-6110
                        </p>

                    </section>

                </div>

            </a>

            <!-- LOCALIZAÇÃO -->
            <a href="https://maps.google.com"
               target="_blank"
               class="sessao-link">

                <div class="sessao">

                    <img class="icon"
                         src="img/icons/loc.png"
                         alt="Localização"
                         height="30"
                         width="30">

                    <section>

                        <p class="info">LOCALIZAÇÃO</p>

                        <p class="info">
                            Rua Fulano de Tal, 123
                        </p>

                    </section>

                </div>

            </a>

            <!-- HORÁRIO -->

            <div class="sessao">

                <img class="icon"
                     src="img/icons/relogio.png"
                     alt="Horário"
                     height="30"
                     width="30">

                <section>

                    <p class="info">
                        HORÁRIO COMERCIAL
                    </p>

                    <p class="info">
                        Funcionamento das 11h às 18h
                    </p>

                </section>

            </div>

        </div>

        <!-- FORMULÁRIO -->

        <div class="caixa-form">

            <form action="contato_enviado.php">

                <input
                    class="nome"
                    type="text"
                    placeholder="Digite seu nome"
                    minlength="3"
                    maxlength="30"
                    required>

                <input
                    class="email"
                    type="email"
                    placeholder="Digite seu email"
                    minlength="5"
                    maxlength="50"
                    required>

                <textarea
                    class="descricao"
                    placeholder="Escreva sua mensagem..."
                    minlength="10"
                    maxlength="500"
                    required></textarea>

                <input
                    class="enviar"
                    type="submit"
                    value="Enviar">

            </form>

        </div>

    </div>

</main>

<hr class="foot4">

<footer>
    &copy; Projeto desenvolvido por Bryan Soares e Jonatha de Paula
</footer>

</body>
</html>