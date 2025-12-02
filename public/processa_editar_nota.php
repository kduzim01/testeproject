<?php
session_start();
require_once 'conexao.php';

$id         = $_POST['id'] ?? '';
$disciplina = $_POST['disciplina'] ?? '';
$nota       = $_POST['nota'] ?? '';

if (!$id || !$disciplina || $nota === '') {
    $_SESSION['erro'] = "Preencha todos os campos!";
    header("Location: editar_nota.php?id=$id");
    exit;
}

try {
    $sql = "UPDATE notas SET disciplina = ?, nota = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$disciplina, $nota, $id]);

    $_SESSION['msg'] = "Nota atualizada com sucesso!";
    header("Location: editar_nota.php?id=$id");
    exit;

} catch (Exception $e) {
    $_SESSION['erro'] = "Erro ao atualizar nota: " . $e->getMessage();
    header("Location: editar_nota.php?id=$id");
    exit;
}
