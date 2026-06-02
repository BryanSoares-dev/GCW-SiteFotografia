<?php

$nome1 = $_POST['nome1'];
$nome2 = $_POST['nome2'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$data = $_POST['data'];
$local = $_POST['local'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada</title>

    <link rel="stylesheet" href="css/style_reserva.css">
</head>
<body>

    <div class="reserva-container">

        <div class="reserva-topo">
            <h1>Detalhes da sua reserva</h1>
        </div>

        <div class="reserva-conteudo">

            <div class="info-box">
                <div class="label">Seu nome</div>
                <div class="valor"><?php echo $nome1; ?></div>
            </div>

            <div class="info-box">
                <div class="label">Nome do(a) companheiro(a)</div>
                <div class="valor"><?php echo $nome2; ?></div>
            </div>

            <div class="info-box">
                <div class="label">Telefone</div>
                <div class="valor"><?php echo $tel; ?></div>
            </div>

            <div class="info-box">
                <div class="label">E-mail</div>
                <div class="valor"><?php echo $email; ?></div>
            </div>

            <div class="info-box">
                <div class="label">Data</div>
                <div class="valor"><?php echo $data; ?></div>
            </div>

            <div class="info-box">
                <div class="label">Local do evento</div>
                <div class="valor"><?php echo $local; ?></div>
            </div>

            <a href="index.php" class="btn-voltar">
                Voltar ao início
            </a>

        </div>

    </div>

</body>
</html>