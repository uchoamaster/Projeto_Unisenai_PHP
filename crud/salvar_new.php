<?php
include 'conexao.php';

mysqli_query($conn, "INSERT INTO usuarios(nome,email,telefone,idade,cidade,curso) 
VALUES (
  '$_POST[nome]',
  '$_POST[email]',
  '$_POST[telefone]',
  '$_POST[idade]',
  '$_POST[cidade]',
  '$_POST[curso]'
)");

header("Location: index.php");
?>