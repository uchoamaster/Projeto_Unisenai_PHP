<?php
include 'conexao.php';
?>

<h2>Usuários</h2>

<a href="form.php">Novo</a><br><br>

<table border="1" cellpadding="10">
  <tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Telefone</th>
    <th>Idade</th>
    <th>Cidade</th>
    <th>Curso</th>
  </tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM usuarios");

while ($r = mysqli_fetch_assoc($res)){
  echo "<tr>
    <td>{$r['nome']}</td>
    <td>{$r['email']}</td>
    <td>{$r['telefone']}</td>
    <td>{$r['idade']}</td>
    <td>{$r['cidade']}</td>
    <td>{$r['curso']}</td>
  </tr>";
}
?>

</table>