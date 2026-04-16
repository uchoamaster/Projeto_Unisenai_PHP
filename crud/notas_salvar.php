<?php
// ------------------------------------------------------------
// ARQUIVO: notas_salvar.php
// RESPONSABILIDADE:
// Receber dados do formulario de notas, validar e inserir no banco.
// Exercicios 5, 6, 7, 8 (calculos sao feitos na listagem).
// ------------------------------------------------------------

include 'conexao.php';

function redirect_with_alert($url, $status, $message) {
  header('Location: ' . $url . '?status=' . urlencode($status) . '&msg=' . urlencode($message));
  exit;
}

$aluno_id = $_POST['aluno_id'] ?? '';
$bimestre = trim($_POST['bimestre'] ?? '');
$nota1    = $_POST['nota1'] ?? '';
$nota2    = $_POST['nota2'] ?? '';
$nota3    = $_POST['nota3'] ?? '';
$peso     = $_POST['peso'] ?? '';
$faltas   = $_POST['faltas'] ?? '';

// 1) Validacao de obrigatoriedade.
if (
  $aluno_id === '' ||
  $bimestre === '' ||
  $nota1 === '' ||
  $nota2 === '' ||
  $nota3 === '' ||
  $peso === '' ||
  $faltas === ''
) {
  redirect_with_alert('notas_form.php', 'error', 'Preencha todos os campos obrigatorios.');
}

// 2) Validacao de tipos.
if (
  filter_var($aluno_id, FILTER_VALIDATE_INT) === false ||
  !is_numeric($nota1) || !is_numeric($nota2) || !is_numeric($nota3) ||
  !is_numeric($peso) ||
  filter_var($faltas, FILTER_VALIDATE_INT) === false || (int)$faltas < 0
) {
  redirect_with_alert('notas_form.php', 'error', 'Dados invalidos. Verifique os valores informados.');
}

// 3) Prepared Statement para inserir com seguranca.
$stmt = mysqli_prepare($conn, "INSERT INTO notas_alunos (aluno_id, bimestre, nota1, nota2, nota3, peso, faltas) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
  redirect_with_alert('notas_form.php', 'error', 'Erro ao preparar o cadastro de notas.');
}

$aluno_id = (int)$aluno_id;
$nota1    = (float)$nota1;
$nota2    = (float)$nota2;
$nota3    = (float)$nota3;
$peso     = (float)$peso;
$faltas   = (int)$faltas;

// Tipos: i=int, s=string, d=double
mysqli_stmt_bind_param($stmt, 'isddddi', $aluno_id, $bimestre, $nota1, $nota2, $nota3, $peso, $faltas);

$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if (!$ok) {
  redirect_with_alert('notas_form.php', 'error', 'Nao foi possivel salvar as notas.');
}

redirect_with_alert('notas_index.php', 'success', 'Notas cadastradas com sucesso.');
?>
