<?php
// ------------------------------------------------------------
// ARQUIVO: notas_deletar.php
// RESPONSABILIDADE:
// Receber o id por GET e remover o lancamento de notas.
// ------------------------------------------------------------

include 'conexao.php';

$id = $_GET['id'] ?? '';

if (filter_var($id, FILTER_VALIDATE_INT) === false) {
  header('Location: notas_index.php?status=error&msg=' . urlencode('ID invalido.'));
  exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM notas_alunos WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($ok) {
  header('Location: notas_index.php?status=success&msg=' . urlencode('Lancamento excluido com sucesso.'));
} else {
  header('Location: notas_index.php?status=error&msg=' . urlencode('Erro ao excluir lancamento.'));
}
exit;
?>
