<?php
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../front-end/cadastrar.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = (string) ($_POST['senha'] ?? '');
$telefone = preg_replace('/\D/', '', $_POST['telefone'] ?? '');

if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
    header('Location: ../front-end/cadastrar.php?erro=dados_invalidos');
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare(
        'INSERT INTO usuario (nome, email, senha, telefone)
         VALUES (:nome, :email, :senha, :telefone)'
    );
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash,
        ':telefone' => $telefone === '' ? null : $telefone,
    ]);

    header('Location: ../front-end/login.php?cadastro=sucesso');
    exit;
} catch (PDOException $e) {
    var_dump($e->getMessage()); // DEBUG - remover depois
    exit;
}