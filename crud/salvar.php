<?php
// ------------------------------------------------------------
// ARQUIVO: salvar.php
// RESPONSABILIDADE:
// Receber os dados do formulario de cadastro, validar,
// inserir no banco e redirecionar com feedback visual.
// ------------------------------------------------------------

// Inclui a conexao com banco de dados.
include 'conexao.php';

// Funcao utilitaria para redirecionar com mensagem (status + texto).
// Exemplo de uso:
//   redirect_with_alert('form.php', 'error', 'Mensagem');
function redirect_with_alert($url, $status, $message) {
  header('Location: ' . $url . '?status=' . urlencode($status) . '&msg=' . urlencode($message));
  exit;
}

// Leitura dos campos enviados pelo formulario (metodo POST).
// trim() remove espacos no inicio/fim.
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$idade = $_POST['idade'] ?? '';
$cidade = trim($_POST['cidade'] ?? '');
$curso = trim($_POST['curso'] ?? '');

// 1) Validacao de obrigatoriedade.
if(
  $nome === '' ||
  $email === '' ||
  $telefone === '' ||
  $idade === '' ||
  $cidade === '' ||
  $curso === ''
){
    // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
    // die("Preencha todos os campos obrigatórios.");
    redirect_with_alert('form.php', 'error', 'Preencha todos os campos obrigatorios.');
}

// 2) Validacao de tipo para idade (inteiro positivo).
if (filter_var($idade, FILTER_VALIDATE_INT) === false || (int)$idade < 1) {
  // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
  // die("Informe uma idade valida.");
  redirect_with_alert('form.php', 'error', 'Informe uma idade valida.');
}

// 3) Prepared Statement evita SQL Injection e separa SQL de dados.
$stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nome, email, telefone, idade, cidade, curso) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
  // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
  // die("Erro ao preparar o cadastro.");
  redirect_with_alert('form.php', 'error', 'Erro ao preparar o cadastro.');
}

// 'sssiss' indica os tipos dos parametros:
// s=string, i=integer.
mysqli_stmt_bind_param($stmt, 'sssiss', $nome, $email, $telefone, $idade, $cidade, $curso);

// Executa o insert e guarda resultado para decidir o feedback.
$ok = mysqli_stmt_execute($stmt);

// Fecha o statement para liberar recurso.
mysqli_stmt_close($stmt);

// 4) Tratamento de falha na insercao.
if (!$ok) {
  redirect_with_alert('form.php', 'error', 'Nao foi possivel salvar o usuario.');
}

// 5) Sucesso: volta para listagem com alerta verde.
redirect_with_alert('index.php', 'success', 'Usuario cadastrado com sucesso.');
?>