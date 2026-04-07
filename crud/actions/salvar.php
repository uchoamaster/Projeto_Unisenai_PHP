<?php
include '../config/conexao.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$idade = (int) ($_POST['idade'] ?? 0);
$cidade = trim($_POST['cidade'] ?? '');
$curso = trim($_POST['curso'] ?? '');

if(
    $nome === '' ||
    $email === '' ||
    $telefone === '' ||
    $idade <= 0 ||
    $cidade === '' ||
    $curso === ''
){
    header("Location: ../pages/form.php?erro=campos");
    exit;
}

mysqli_query($conn, "INSERT INTO usuarios(nome,email,telefone,idade,cidade,curso)
VALUES (
  '$nome',
  '$email',
  '$telefone',
  '$idade',
  '$cidade',
  '$curso'
)");

header("Location: ../index.php");
exit;
?>