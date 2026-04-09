<?php
// ------------------------------------------------------------
// ARQUIVO: conexao.php
// RESPONSABILIDADE:
// Criar uma conexao com o banco MySQL para ser reutilizada
// em todos os arquivos do projeto (listagem, cadastro, edicao etc).
// ------------------------------------------------------------

// mysqli_connect(host, usuario, senha, banco)
// Ajuste estes dados de acordo com o seu ambiente local.
$conn = mysqli_connect("localhost", "root", "root", "crud_simples");

// Em aula, voce pode descomentar este bloco para testar erro de conexao.
// if (!$conn) {
//   die('Falha na conexao: ' . mysqli_connect_error());
// }
?>