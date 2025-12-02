<?php
$PERFIS_PERMITIDOS = ['administrador', 'professor'];
require_once 'verifica_sessao.php';
require_once 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID da nota não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM notas WHERE id = ?");
$stmt->execute([$id]);
$nota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$nota) {
    die("Nota não encontrada.");
}

$erro = $_SESSION['erro'] ?? null;
$msg  = $_SESSION['msg']  ?? null;
unset($_SESSION['erro'], $_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Editar Nota</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">

  <div class="header">
    <div class="muted">🎓 Sistema Escolar</div>
    <div class="muted">Olá, <?= htmlspecialchars($_SESSION['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
  </div>

  <div class="card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="margin-top: 0;">Editar Nota</h2>

    <?php if ($erro): ?>
      <div class="alert error"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <?php if ($msg): ?>
      <div class="alert ok"><?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post" action="processa_editar_nota.php">

      <input type="hidden" name="id" value="<?= $nota['id'] ?>">

      <div class="field">
        <label for="disciplina">Disciplina</label>
        <input type="text" id="disciplina" name="disciplina"
               value="<?= htmlspecialchars($nota['disciplina']) ?>" required>
      </div>

      <div class="field">
        <label for="nota">Nota</label>
        <input type="number" id="nota" name="nota"
               min="0" max="10" step="0.1"
               value="<?= htmlspecialchars($nota['nota']) ?>" required>
      </div>

      <div class="bttns" style="margin-top: 30px;">
        <button class="btn" type="submit">Salvar Alterações</button>
        <button class="btn light" type="button" onclick="window.location.href='listar_alunos.php'">Voltar</button>
      </div>

    </form>
  </div>

  <div class="footer center">© <?= date('Y'); ?> Sistema Escolar</div>
</div>
</body>
</html>
