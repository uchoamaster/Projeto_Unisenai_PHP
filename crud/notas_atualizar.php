<?php
// ------------------------------------------------------------
// ARQUIVO: notas_atualizar.php
// RESPONSABILIDADE:
// Receber dados do formulario de edicao de notas, validar,
// atualizar no banco e redirecionar com feedback visual.
// Exercicio 11 (bonus).
// ------------------------------------------------------------

include 'conexao.php';

function redirect_with_alert($url, $status, $message) {
  header('Location: ' . $url . '?status=' . urlencode($status) . '&msg=' . urlencode($message));
  exit;
}

$id       = $_POST['id'] ?? '';
$aluno_id = $_POST['aluno_id'] ?? '';
$bimestre = trim($_POST['bimestre'] ?? '');
$nota1    = $_POST['nota1'] ?? '';
$nota2    = $_POST['nota2'] ?? '';
$nota3    = $_POST['nota3'] ?? '';
$peso     = $_POST['peso'] ?? '';
$faltas   = $_POST['faltas'] ?? '';

// 1) Validacao de obrigatoriedade.
if (
  $id === '' ||
  $aluno_id === '' ||
  $bimestre === '' ||
  $nota1 === '' ||
  $nota2 === '' ||
  $nota3 === '' ||
  $peso === '' ||
  $faltas === ''
) {
  if (filter_var($id, FILTER_VALIDATE_INT) !== false) {
    header("Location: notas_editar.php?id=" . urlencode($id) . "&status=error&msg=" . urlencode('Preencha todos os campos obrigatorios.'));
    exit;
  }
  redirect_with_alert('notas_index.php', 'error', 'Preencha todos os campos obrigatorios.');
}

// 2) Validacao de tipos.
if (
  filter_var($id, FILTER_VALIDATE_INT) === false ||
  filter_var($aluno_id, FILTER_VALIDATE_INT) === false ||
  !is_numeric($nota1) || !is_numeric($nota2) || !is_numeric($nota3) ||
  !is_numeric($peso) ||
  filter_var($faltas, FILTER_VALIDATE_INT) === false || (int)$faltas < 0
) {
  if (filter_var($id, FILTER_VALIDATE_INT) !== false) {
    header("Location: notas_editar.php?id=" . urlencode($id) . "&status=error&msg=" . urlencode('Dados invalidos. Verifique os valores.'));
    exit;
  }
  redirect_with_alert('notas_index.php', 'error', 'Dados invalidos para atualizacao.');
}

// 3) Prepared Statement para atualizar com seguranca.
$stmt = mysqli_prepare($conn, "UPDATE notas_alunos SET aluno_id = ?, bimestre = ?, nota1 = ?, nota2 = ?, nota3 = ?, peso = ?, faltas = ? WHERE id = ?");

if (!$stmt) {
  header("Location: notas_editar.php?id=" . urlencode($id) . "&status=error&msg=" . urlencode('Erro ao preparar a atualizacao.'));
  exit;
}

$id       = (int)$id;
$aluno_id = (int)$aluno_id;
$nota1    = (float)$nota1;
$nota2    = (float)$nota2;
$nota3    = (float)$nota3;
$peso     = (float)$peso;
$faltas   = (int)$faltas;

// Tipos: i s d d d d i i
mysqli_stmt_bind_param($stmt, 'isddddii', $aluno_id, $bimestre, $nota1, $nota2, $nota3, $peso, $faltas, $id);

$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if (!$ok) {
  header("Location: notas_editar.php?id=" . urlencode($id) . "&status=error&msg=" . urlencode('Nao foi possivel atualizar as notas.'));
  exit;
}

redirect_with_alert('notas_index.php', 'success', 'Notas atualizadas com sucesso.');
?>
