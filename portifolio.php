<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portifólio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_portifolio.css">
</head>
<body>
    <header>
        <div class="menu">
        <img class="logo" src="img/logo.png" alt="logomarca" height="80px" width="250px">
        <ul>
                <a href="index.php"><li>Inicio</li></a>
                <a href="portifolio.php"><li>Portfólio</li></a>
                <a href="pacotes.php"><li>Serviços e Pacotes</li></a>
                <a href="sobre.php"><li>Sobre Mim</li></a>
                <a href="contato.php"><li>Contato</li></a>
            </ul>
        </div>
    </header>
    <hr>
 
    <main>
        <h1>SOBRE MEU PORTIFÓLIO</h1>
        <p class="portfolio-descricao">
            Registros autênticos e emocionantes de casamentos, eventos e ensaios, capturando cada detalhe com sensibilidade e um olhar artístico para transformar momentos especiais em memórias inesquecíveis.
        </p>

        <div class="portfolio-filtros">
            <button class="filtro-btn ativo" data-categoria="todos">TODOS</button>
            <button class="filtro-btn" data-categoria="casamentos">CASAMENTOS</button>
            <button class="filtro-btn" data-categoria="eventos">EVENTOS</button>
            <button class="filtro-btn" data-categoria="ensaios">ENSAIOS</button>
        </div>

        <div class="galeria">
            <!-- MODAL, PARA ABRIR E FECHAR A FOTO INDIVIDUALMENTE -->
        <div class="modal" id="modal">
            <span class="fechar">&times;</span>
            <img class="modal-img" id="modal-img">
        </div>

                      <!-- APENAS FOTOS DE EVENTOS -->
        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento1.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento2.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento3.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento4.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento5.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento6.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento7.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento8.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento9.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento10.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento11.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="eventos">
            <img src="img/evento/evento12.jpg" loading="lazy" alt="Ensaio">
        </div>


            <!-- APENAS FOTOS DE CASAMENTOS -->
        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento1.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento2.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento3.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento4.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento5.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento6.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento7.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento8.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento9.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento10.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento11.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="casamentos">
            <img src="img/casamento/casamento12.jpg" loading="lazy" alt="Ensaio">
        </div>


        <!-- APENAS FOTOS DE ENSAIOS -->
         <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio1.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio2.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio3.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio4.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio5.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio6.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio7.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio8.jpg" loading="lazy" alt="Casamento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio9.jpg" loading="lazy" alt="Evento">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio10.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio11.jpg" loading="lazy" alt="Ensaio">
        </div>

        <div class="foto" data-categoria="ensaios">
            <img src="img/ensaio/ensaio12.jpg" loading="lazy" alt="Ensaio">
        </div>

    </main>
    <hr class="foot">
    <footer>
        &copy; Projeto desenvolvido por Bryan Soares e Jonatha de Paula
    </footer>
</body>

    <!-- RESPONSAVEL PELO FUNCIONAMENTO DA ABA -->
    <script> 
        const botoes = document.querySelectorAll(".filtro-btn");
        const fotos = document.querySelectorAll(".foto");

        botoes.forEach(botao => {
        botao.addEventListener("click", () => {
        
            botoes.forEach(btn => btn.classList.remove("ativo"));

            botao.classList.add("ativo");

            const categoria = botao.dataset.categoria;

            fotos.forEach(foto => {
            if (
                categoria === "todos" ||
                foto.dataset.categoria === categoria
            ) {
                foto.classList.remove("oculto");
            } else {
                foto.classList.add("oculto");
            }
            });
        });
        });
    </script>

    <!-- RESPONSÁVEL PELO FUNCIONAMENTO DO MODAL -->
    <script>
        const modal = document.getElementById("modal");
        const modalImg = document.getElementById("modal-img");
        const fechar = document.querySelector(".fechar");

        const imagens = document.querySelectorAll(".foto img");

        imagens.forEach(img => {
        img.addEventListener("click", () => {
            modal.style.display = "flex";
            modalImg.src = img.src;
            modalImg.alt = img.alt;
        });
        });

        fechar.addEventListener("click", () => {
        modal.style.display = "none";
        });

        modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
        });

        document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            modal.style.display = "none";
        }
        });
    </script>

</html>