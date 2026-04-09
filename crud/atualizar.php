<?php
// ------------------------------------------------------------
// ARQUIVO: atualizar.php
// RESPONSABILIDADE:
// Receber os dados do formulario de edicao, validar,
// atualizar no banco e redirecionar com feedback visual.
// ------------------------------------------------------------

// Inclui a conexao com banco de dados.
include 'conexao.php';

// Funcao utilitaria para redirecionar com mensagem.
function redirect_with_alert($url, $status, $message) {
  header('Location: ' . $url . '?status=' . urlencode($status) . '&msg=' . urlencode($message));
  exit;
}

// Leitura dos campos enviados por POST.
$id = $_POST['id'] ?? '';
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$idade = $_POST['idade'] ?? '';
$cidade = trim($_POST['cidade'] ?? '');
$curso = trim($_POST['curso'] ?? '');

// 1) Validacao de campos obrigatorios.
if (
  $id === '' ||
  $nome === '' ||
  $email === '' ||
  $telefone === '' ||
  $idade === '' ||
  $cidade === '' ||
  $curso === ''
) {
  // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
  // die('Preencha todos os campos obrigatorios.');
  $idForReturn = urlencode((string)$id);
  header("Location: editar.php?id={$idForReturn}&status=error&msg=" . urlencode('Preencha todos os campos obrigatorios.'));
  exit;
}

// 2) Validacao de tipos (id e idade precisam ser inteiros validos).
if (
  filter_var($id, FILTER_VALIDATE_INT) === false ||
  filter_var($idade, FILTER_VALIDATE_INT) === false ||
  (int)$idade < 1
) {
  // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
  // die('Dados invalidos para atualizacao.');

  // Se o id for invalido, nao faz sentido voltar para a tela de edicao.
  if (filter_var($id, FILTER_VALIDATE_INT) === false) {
    redirect_with_alert('index.php', 'error', 'Dados invalidos para atualizacao.');
  }

  $idForReturn = urlencode((string)$id);
  header("Location: editar.php?id={$idForReturn}&status=error&msg=" . urlencode('Dados invalidos para atualizacao.'));
  exit;
}

// 3) Prepared Statement para atualizar com seguranca.
$stmt = mysqli_prepare($conn, "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, idade = ?, cidade = ?, curso = ? WHERE id = ?");

if (!$stmt) {
  // Alteracao didatica: substituimos die() por redirecionamento com alerta Bootstrap.
  // die('Erro ao preparar a atualizacao.');
  $idForReturn = urlencode((string)$id);
  header("Location: editar.php?id={$idForReturn}&status=error&msg=" . urlencode('Erro ao preparar a atualizacao.'));
  exit;
}

// Tipos: sssissi (nome, email, telefone, idade, cidade, curso, id)
mysqli_stmt_bind_param($stmt, 'sssissi', $nome, $email, $telefone, $idade, $cidade, $curso, $id);

// Executa update e guarda resultado para feedback.
$ok = mysqli_stmt_execute($stmt);

// Fecha o statement para liberar recurso.
mysqli_stmt_close($stmt);

// 4) Falha no update.
if (!$ok) {
  $idForReturn = urlencode((string)$id);
  header("Location: editar.php?id={$idForReturn}&status=error&msg=" . urlencode('Nao foi possivel atualizar o usuario.'));
  exit;
}

// 5) Sucesso: volta para listagem com alerta verde.
redirect_with_alert('index.php', 'success', 'Usuario atualizado com sucesso.');
?>