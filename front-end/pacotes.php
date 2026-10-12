<?php
session_start();
if (empty($_SESSION['csrf_pacotes'])) $_SESSION['csrf_pacotes'] = bin2hex(random_bytes(32));
$csrfPacotes = $_SESSION['csrf_pacotes'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Serviços e Pacotes | Rafael Lima Fotografia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_pacotes.css">
    <link rel="stylesheet" href="css/modal-agendamento.css">
    <link rel="stylesheet" href="css/site-theme.css">
</head>

<body class="pacotes-page">

<?php include_once __DIR__ . '/navbar.php'; ?>

    <hr>

    <main class="content">

        <div class="geral">

            <section class="apresentacao">

                <h1>ESCOLHA COMO ETERNIZAR SUA HISTÓRIA</h1>

                <p class="slogan-apresentacao">
                    Experiências personalizadas para capturar a essência de cada momento.
                </p>

            </section>

            <div class="pacotes">

                <!-- CASAMENTO -->

                <div class="card-pacote">

                    <div class="card-topo">
                        CASAMENTO
                    </div>

                    <div class="card-conteudo">

                        <p class="paragrafo-conteudo">
                            • 10 horas (Making of + Cerimônia + Festa)
                        </p>

                        <p class="paragrafo-conteudo">
                            • 600 fotos editadas
                        </p>

                        <p class="paragrafo-conteudo">
                            • Fotos para Redes Sociais em 24h
                        </p>

                        <p class="paragrafo-conteudo">
                            • Vídeos inesquecíveis dos momentos mais importantes
                        </p>

                        <h2>R$ 5.800,00</h2>

                        <button
                            class="btn-adquirir btn-agendar"
                            data-plano="casamento"
                            data-nome="Casamento"
                            data-valor="5800.00">

                            Adquirir plano

                        </button>

                    </div>

                </div>

                <!-- EVENTOS -->

                <div class="card-pacote">

                    <div class="card-topo">
                        EVENTOS
                    </div>

                    <div class="card-conteudo">

                        <p class="paragrafo-conteudo">
                            • Plano ideal para aniversários e confraternizações
                        </p>

                        <p class="paragrafo-conteudo">
                            • 5 horas de cobertura
                        </p>

                        <p class="paragrafo-conteudo">
                            • 250 fotos editadas
                        </p>

                        <p class="paragrafo-conteudo">
                            • Fotos para redes sociais em 24h
                        </p>

                        <h2>R$ 1.600,00</h2>

                        <button
                            class="btn-adquirir btn-agendar"
                            data-plano="evento"
                            data-nome="Eventos"
                            data-valor="1600.00">

                            Adquirir plano

                        </button>

                    </div>

                </div>

                <!-- ENSAIOS -->

                <div class="card-pacote">

                    <div class="card-topo">
                        ENSAIOS
                    </div>

                    <div class="card-conteudo">

                        <p class="paragrafo-conteudo">
                            • Plano ideal para fotos em família ou casal
                        </p>

                        <p class="paragrafo-conteudo">
                            • 2 horas de cobertura
                        </p>

                        <p class="paragrafo-conteudo">
                            • 50 fotos tratadas
                        </p>

                        <p class="paragrafo-conteudo">
                            • 3 looks + locação externa
                        </p>

                        <h2>R$ 1.380,00</h2>

                        <button
                            class="btn-adquirir btn-agendar"
                            data-plano="ensaio"
                            data-nome="Ensaios"
                            data-valor="1380.00">

                            Adquirir plano

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </main>

    <hr class="foot2">

    <footer>
        &copy; Projeto desenvolvido por Bryan Soares e Jonatha de Paula
    </footer>

    <!-- ===== MODAL DE AGENDAMENTO ===== -->
    <div class="modal-overlay" id="modalAgendamento" hidden>
        <div class="modal-agendamento" role="dialog" aria-modal="true" aria-labelledby="agTitulo">

            <button type="button" class="ag-fechar" aria-label="Fechar">&times;</button>

            <span class="badge">Reserve sua data</span>
            <h2 id="agTitulo">Agendar: <span id="agNome">Plano</span></h2>

            <div class="ag-resumo">
                <div class="ag-plano">
                    <span>Plano selecionado</span>
                    <strong id="agPlanoNome">—</strong>
                </div>
                <div class="ag-total">
                    <span>Valor do pacote</span>
                    <strong id="agValor">R$ 0,00</strong>
                </div>
            </div>

            <form action="../back-end/asaas-pagamento/cobranca-pacote.php" method="POST" id="formAgendamento" autocomplete="off">

                <input type="hidden" name="plano" id="agPlanoInput">

                <div class="input-group">
                    <label for="agNomeCliente">Nome completo</label>
                    <input type="text" name="nomeCliente" id="agNomeCliente" placeholder="Seu nome completo" required>
                </div>

                <div class="ag-linha">
                    <div class="input-group">
                        <label for="agTelefone">Telefone para contato</label>
                        <input type="tel" name="telefoneCliente" id="agTelefone" placeholder="(00) 00000-0000" maxlength="15" required>
                    </div>
                    <div class="input-group">
                        <label for="agData">Data da festividade</label>
                        <input type="date" name="dataFesta" id="agData" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="agEmail">E-mail</label>
                    <input type="email" name="emailCliente" id="agEmail" placeholder="voce@exemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="agCpf">CPF do pagador</label>
                    <input type="text" name="cpfCliente" id="agCpf" inputmode="numeric" placeholder="000.000.000-00" maxlength="14" required>
                </div>
                <div class="ag-pix"><p>Pagamento via <strong>Pix pelo Asaas</strong>. O valor integral do pacote será cobrado. Os dados do cartão não são solicitados neste site.</p></div>
                <p id="agErro" role="alert" hidden></p>
                <button type="submit" class="btn-adquirir ag-confirmar">Gerar cobrança Pix</button>
                <p class="ag-nota">A cobrança vence em 3 dias. A data será confirmada após o pagamento.</p>

            </form>
            <section id="resultadoPix" hidden aria-live="polite">
                <h3>Finalize o pagamento</h3>
                <p id="agPixValor"></p>
                <img id="agPixImagem" alt="QR Code Pix" hidden style="max-width:240px;width:100%;margin:16px auto">
                <label for="agPixCodigo">Pix copia e cola</label>
                <textarea id="agPixCodigo" readonly rows="4" style="width:100%"></textarea>
                <button type="button" id="agCopiarPix" class="btn-adquirir">Copiar código Pix</button>
                <a id="agPixFatura" target="_blank" rel="noopener" hidden>Abrir pagamento no Asaas</a>
            </section>

        </div>
    </div>

    <script>
        var modal = document.getElementById('modalAgendamento');
        var ultimoFoco = null;
        var brl = function (v) { return v.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }); };
        function abrirModal(btn) {
            ultimoFoco = btn;
            document.getElementById('agPlanoInput').value = btn.dataset.plano;
            document.getElementById('agNome').textContent = btn.dataset.nome;
            document.getElementById('agPlanoNome').textContent = btn.dataset.nome;
            document.getElementById('agValor').textContent = brl(parseFloat(btn.dataset.valor));
            document.getElementById('formAgendamento').hidden = false;
            document.getElementById('resultadoPix').hidden = true;
            document.getElementById('agErro').hidden = true;
            modal.hidden = false;
            document.body.style.overflow = 'hidden';
            setTimeout(function () { document.getElementById('agNomeCliente').focus(); }, 50);
        }
        function fecharModal() {
            modal.hidden = true;
            document.body.style.overflow = '';
            if (ultimoFoco) ultimoFoco.focus();
        }
        document.querySelectorAll('.btn-agendar').forEach(function (b) { b.addEventListener('click', function () { abrirModal(b); }); });
        modal.addEventListener('click', function (e) { if (e.target === modal) fecharModal(); });
        modal.querySelector('.ag-fechar').addEventListener('click', fecharModal);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !modal.hidden) fecharModal(); });
        document.getElementById('agCpf').addEventListener('input', function () {
            var v = this.value.replace(/\D/g, '').slice(0, 11);
            this.value = v.replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        });
        document.getElementById('agTelefone').addEventListener('input', function (e) {
            var v = e.target.value.replace(/\D/g, '').slice(0, 11);
            v = v.replace(/^(\d{2})(\d)/, '($1) $2').replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = v;
        });
        var formPagamento = document.getElementById('formAgendamento');
        formPagamento.addEventListener('submit', async function (e) {
            e.preventDefault();
            var erro = document.getElementById('agErro');
            var botao = formPagamento.querySelector('[type="submit"]');
            erro.hidden = true; botao.disabled = true; botao.textContent = 'Gerando cobrança…';
            try {
                var resposta = await fetch(formPagamento.action, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': <?= json_encode($csrfPacotes) ?> },
                    body: JSON.stringify({
                        plano: document.getElementById('agPlanoInput').value,
                        nome: document.getElementById('agNomeCliente').value,
                        email: document.getElementById('agEmail').value,
                        telefone: document.getElementById('agTelefone').value.replace(/\D/g, ''),
                        cpf: document.getElementById('agCpf').value.replace(/\D/g, ''),
                        dataFesta: document.getElementById('agData').value
                    })
                });
                var dados = await resposta.json();
                if (!resposta.ok || !dados.ok) throw new Error(dados.erro || 'Não foi possível gerar a cobrança.');
                document.getElementById('agPixValor').textContent = brl(Number(dados.valor));
                var codigo = document.getElementById('agPixCodigo');
                codigo.value = dados.pixCopiaECola || ''; codigo.hidden = !dados.pixCopiaECola;
                document.getElementById('agCopiarPix').hidden = !dados.pixCopiaECola;
                var imagem = document.getElementById('agPixImagem'); imagem.hidden = !dados.pixImagem;
                if (dados.pixImagem) imagem.src = dados.pixImagem;
                var fatura = document.getElementById('agPixFatura'); fatura.hidden = !dados.invoiceUrl;
                if (dados.invoiceUrl) fatura.href = dados.invoiceUrl;
                formPagamento.hidden = true; document.getElementById('resultadoPix').hidden = false;
            } catch (err) {
                erro.textContent = err.message || 'Falha de comunicação. Tente novamente.'; erro.hidden = false;
            } finally { botao.disabled = false; botao.textContent = 'Gerar cobrança Pix'; }
        });
        document.getElementById('agCopiarPix').addEventListener('click', async function () {
            var campo = document.getElementById('agPixCodigo');
            try { await navigator.clipboard.writeText(campo.value); this.textContent = 'Código copiado'; }
            catch (e) { campo.select(); document.execCommand('copy'); this.textContent = 'Código copiado'; }
        });
    </script>

</body>

</html>
