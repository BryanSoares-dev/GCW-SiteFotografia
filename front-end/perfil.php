<?php
session_start();
if (empty($_SESSION['csrf_perfil'])) {
    $_SESSION['csrf_perfil'] = bin2hex(random_bytes(32));
}
$csrfPerfil = $_SESSION['csrf_perfil'];
$flashSenha = $_SESSION['flash_senha'] ?? null;
$flashConta = $_SESSION['flash_conta'] ?? null;
unset($_SESSION['flash_conta']);
unset($_SESSION['flash_senha']);
// TODO: substituir pela lógica real de autenticação/banco de dados
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$nomeUsuario = $_SESSION['nome'] ?? 'Usuário';
$emailUsuario = $_SESSION['email'] ?? '';
$avatarUsuario = $_SESSION['avatar'] ?? 'img/avatar-default.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_perfil.css">
    <link rel="stylesheet" href="css/site-theme.css">
</head>
<body>

<?php include_once __DIR__ . '/navbar.php';?>

    <hr>

    <main class="content">
        <div class="perfil-container">

            <!-- TOPO: AVATAR + NOME -->
            <div class="perfil-topo">
                <div class="avatar-wrapper">
                    <img src="<?php echo htmlspecialchars($avatarUsuario); ?>" alt="Avatar do usuário" class="avatar">
                </div>

                <div class="perfil-identidade">
                    <span class="perfil-etiqueta">Área do cliente</span>
                    <h1><?php echo htmlspecialchars($nomeUsuario); ?></h1>
                    <p><?php echo htmlspecialchars($emailUsuario); ?></p>
                </div>
            </div>

            <!-- CORPO -->
            <div class="perfil-corpo">
                <?php if (is_string($flashConta) && $flashConta !== ''): ?>
                    <p class="senha-feedback" role="status"><?= htmlspecialchars($flashConta, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <!-- DADOS DA CONTA -->
                <section class="secao secao-dados">
                    <h2>Dados da conta</h2>
                    <p class="secao-descricao">Informações usadas para identificar sua conta.</p>

                    <div class="campo">
                        <label for="nome">Nome de usuário</label>
                        <div class="campo-valor" id="nome"><?php echo htmlspecialchars($nomeUsuario); ?></div>
                    </div>

                    <div class="campo">
                        <label for="email">Email</label>
                        <div class="campo-valor" id="email"><?php echo htmlspecialchars($emailUsuario); ?></div>
                    </div>
                </section>

                <!-- REDEFINIR SENHA -->
                <section class="secao secao-senha">
                    <h2>Segurança</h2>
                    <p class="secao-descricao">Atualize sua senha para manter o acesso protegido.</p>

                    <form action="../back-end/atualizar_senha.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfPerfil, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if (is_array($flashSenha)): ?>
                            <p class="senha-feedback <?= htmlspecialchars($flashSenha['tipo'] ?? 'erro', ENT_QUOTES, 'UTF-8') ?>" role="status"><?= htmlspecialchars($flashSenha['mensagem'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <div class="campo">
                            <label for="senha-atual">Senha atual</label>
                            <input type="password" id="senha-atual" name="senha_atual" placeholder="Digite sua senha atual" autocomplete="current-password" required>
                        </div>

                        <div class="linha-senha">
                            <div class="campo">
                                <label for="nova-senha">Nova senha</label>
                                <input type="password" id="nova-senha" name="nova_senha" placeholder="Digite a nova senha (mínimo 8 caracteres)" minlength="8" autocomplete="new-password" required>
                            </div>

                            <div class="campo">
                                <label for="confirmar-senha">Confirmar nova senha</label>
                                <input type="password" id="confirmar-senha" name="confirmar_senha" placeholder="Repita a nova senha" minlength="8" autocomplete="new-password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-salvar">Salvar alterações</button>
                    </form>
                </section>

                <!-- AÇÕES DA CONTA -->
                <section class="acoes-conta" aria-labelledby="titulo-acoes-conta">
                    <div class="acoes-intro">
                        <h2 id="titulo-acoes-conta">Ações da conta</h2>
                        <p>Gerencie sua sessão ou remova sua conta e seus dados de acesso.</p>
                    </div>
                    <form class="form-sair" action="../back-end/logout.php" method="POST">
                        <button type="submit" class="btn-sair">Sair da conta</button>
                    </form>
                    <form class="form-exclusao" action="../back-end/excluir_conta.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Essa ação não pode ser desfeita.');">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfPerfil, ENT_QUOTES, 'UTF-8') ?>">
                        <div class="campo campo-exclusao">
                            <label for="senha-exclusao">Senha para confirmar a exclusão</label>
                            <input type="password" id="senha-exclusao" name="senha_exclusao" autocomplete="current-password" required>
                        </div>
                        <button type="submit" class="btn-excluir">Excluir conta</button>
                    </form>
                </section>

            </div>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Todos os direitos reservados.</p>
    </footer>

</body>
</html>
