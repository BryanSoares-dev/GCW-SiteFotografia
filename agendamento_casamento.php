<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento - Rafael Lima Fotografia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_agendamento.css">
</head>

<body>

    <div class="container">

        <div class="topo">
            <h1>AGENDE SEU CASAMENTO</h1>
            <p>Preencha os dados abaixo para solicitar seu agendamento.</p>
        </div>

        <form class="formulario"
              action="agendamento_confirmado.php"
              method="post">

            <h2>1. DETALHES</h2>

            <div class="names">

                <div class="nome">

                    <input
                        type="text"
                        name="nome1"
                        placeholder="SEU NOME"
                        minlength="2"
                        maxlength="30"
                        autocomplete="name"
                        required>

                </div>

                <div class="nome-companheiro">

                    <input
                        type="text"
                        name="nome2"
                        placeholder="NOME DO(A) COMPANHEIRO(A)"
                        minlength="2"
                        maxlength="30"
                        required>

                </div>

            </div>

            <div class="dados">

                <div class="email">

                    <input
                        type="email"
                        name="email"
                        placeholder="DIGITE SEU E-MAIL"
                        maxlength="50"
                        autocomplete="email"
                        required>

                </div>

                <div class="telefone">

                    <input
                        type="tel"
                        name="tel"
                        placeholder="DIGITE SEU TELEFONE"
                        maxlength="15"
                        autocomplete="tel"
                        required>

                </div>

            </div>

            <div class="infos-pacote">

                <div class="data-evento">

                    <input
                        type="date"
                        name="data"
                        required>

                </div>

                <div class="local-evento">

                    <input
                        type="text"
                        name="local"
                        placeholder="LOCAL DO EVENTO"
                        maxlength="50"
                        required>

                </div>

            </div>

            <input
                type="submit"
                class="envio"
                value="Enviar">

        </form>

        <a href="pacotes.php">
            <button class="voltar">
                Voltar
            </button>
        </a>

    </div>

</body>
</html>