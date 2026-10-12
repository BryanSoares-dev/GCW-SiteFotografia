<?php
$portfolioFotos = [];
foreach (['evento' => 'Evento', 'casamento' => 'Casamento', 'ensaio' => 'Ensaio'] as $pasta => $categoria) {
    for ($numero = 1; $numero <= 12; $numero++) {
        $portfolioFotos[] = [
            'src' => "img/galeria/{$pasta}/{$pasta}{$numero}.jpg",
            'alt' => "{$categoria} fotografado por Rafael Lima",
            'categoria' => $pasta,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rafael Lima Fotografia</title>
    <meta name="description" content="Fotógrafo especializado em casamentos, eventos e ensaios. Capturando emoções e criando memórias inesquecíveis.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/site-theme.css">
</head>
<body class="home_fundo">
<?php include_once __DIR__ . '/navbar.php'; ?>
    <hr>
    <main class="content">
        <section class="home">
            <h1>Rafael Lima</h1>
            <p class="slogan">Capturando emoções e criando memórias.</p>
            <a href="#portifolio" class="portfolio-link"><button type="button">Conheça o portfólio</button></a>
        </section>
    </main>
    <section class="portifolio" id="portifolio" aria-labelledby="titulo-portifolio">
        <div class="portifolio-intro">
            <h2 id="titulo-portifolio">Portfólio</h2>
            <p>Registros autênticos que transformam momentos especiais em memórias inesquecíveis.</p>
        </div>
        <button class="abrir-categorias" type="button" aria-haspopup="dialog" aria-controls="modal-categorias">
            Categorias: <span class="categoria-atual">Todas as fotos</span>
        </button>
        <dialog class="modal-categorias" id="modal-categorias" aria-labelledby="titulo-categorias">
            <div class="modal-categorias-conteudo">
                <button class="fechar-categorias" type="button" aria-label="Fechar categorias">&times;</button>
                <h3 id="titulo-categorias">Escolha uma categoria</h3>
                <div class="opcoes-categoria">
                    <button type="button" class="categoria-btn ativo" data-categoria="todos">Todas as fotos</button>
                    <button type="button" class="categoria-btn" data-categoria="casamento">Casamentos</button>
                    <button type="button" class="categoria-btn" data-categoria="ensaio">Ensaios</button>
                    <button type="button" class="categoria-btn" data-categoria="evento">Eventos</button>
                </div>
            </div>
        </dialog>
        <div class="galeria-portifolio">
            <?php foreach ($portfolioFotos as $indice => $foto): ?>
                <figure class="foto-portifolio<?= $indice >= 3 ? ' foto-portifolio--oculta' : '' ?>" data-categoria="<?= htmlspecialchars($foto['categoria'], ENT_QUOTES, 'UTF-8') ?>">
                    <img <?= $indice < 3 ? 'src' : 'data-src' ?>="<?= htmlspecialchars($foto['src'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($foto['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="<?= $indice < 3 ? 'eager' : 'lazy' ?>" decoding="async">
                </figure>
            <?php endforeach; ?>
        </div>
        <button class="ver-mais" type="button" aria-expanded="false">Ver mais</button>
    </section>
    <footer>&copy; Projeto desenvolvido por Bryan Soares e Jonatha de Paula</footer>
    <script>
        const botaoVerMais = document.querySelector('.ver-mais');
        const fotos = [...document.querySelectorAll('.foto-portifolio')];
        const modalCategorias = document.querySelector('#modal-categorias');
        const botaoAbrirCategorias = document.querySelector('.abrir-categorias');
        const botaoFecharCategorias = document.querySelector('.fechar-categorias');
        const botoesCategoria = document.querySelectorAll('.categoria-btn');
        const categoriaAtual = document.querySelector('.categoria-atual');
        let categoriaSelecionada = 'todos';
        let galeriaExpandida = false;
        const observadorDeImagens = new IntersectionObserver((entradas, observador) => {
            entradas.forEach((entrada) => {
                if (!entrada.isIntersecting) return;
                const imagem = entrada.target.querySelector('img');
                if (!imagem.dataset.src) return;
                imagem.src = imagem.dataset.src;
                imagem.removeAttribute('data-src');
                observador.unobserve(entrada.target);
            });
        }, { rootMargin: '300px 0px' });
        function atualizarGaleria() {
            const fotosDaCategoria = fotos.filter((foto) => categoriaSelecionada === 'todos' || foto.dataset.categoria === categoriaSelecionada);
            fotos.forEach((foto) => {
                const indice = fotosDaCategoria.indexOf(foto);
                const deveExibir = indice !== -1 && (galeriaExpandida || indice < 3);
                foto.classList.toggle('foto-portifolio--oculta', !deveExibir);
                if (deveExibir) observadorDeImagens.observe(foto);
            });
            botaoVerMais.hidden = fotosDaCategoria.length <= 3;
            botaoVerMais.textContent = galeriaExpandida ? 'Ver menos' : 'Ver mais';
            botaoVerMais.setAttribute('aria-expanded', String(galeriaExpandida));
        }
        botaoVerMais.addEventListener('click', () => {
            galeriaExpandida = !galeriaExpandida;
            atualizarGaleria();
            if (!galeriaExpandida) document.querySelector('.galeria-portifolio').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        botaoAbrirCategorias.addEventListener('click', () => modalCategorias.showModal());
        botaoFecharCategorias.addEventListener('click', () => modalCategorias.close());
        botoesCategoria.forEach((botao) => botao.addEventListener('click', () => {
            categoriaSelecionada = botao.dataset.categoria;
            galeriaExpandida = false;
            categoriaAtual.textContent = botao.textContent;
            botoesCategoria.forEach((opcao) => opcao.classList.toggle('ativo', opcao === botao));
            atualizarGaleria();
            modalCategorias.close();
        }));
        modalCategorias.addEventListener('click', (evento) => {
            if (evento.target === modalCategorias) modalCategorias.close();
        });
    </script>
</body>
</html>