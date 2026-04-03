<?php
include 'conexao.php';
?>

<h2>Usuários</h2>

<a href="form.php">Novo</a><br><br>

<?php
$res = mysqli_query($conn, "SELECT * FROM usuarios");

while ($r = mysqli_fetch_assoc($res)){
  echo 
    $r['nome'] . " - " . 
    $r['email'] . " - " . 
    $r['telefone'] . " - " . 
    $r['idade'] . " - " . 
    $r['cidade'] . " - " . 
    $r['curso'] . 
    "<br>";
}
?>