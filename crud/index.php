<?php
include 'config/conexao.php';

$pageTitle = 'Usuarios';
$basePath = '';
include 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0"><i class="bi bi-people-fill me-2"></i>Usuarios</h2>
  <a href="pages/form.php" class="btn btn-primary"><i class="bi bi-person-plus-fill me-1"></i>Novo</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Idade</th>
            <th>Cidade</th>
            <th>Curso</th>
            <th>Acoes</th>
          </tr>
        </thead>
        <tbody>
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
              <td>
                <a class='btn btn-sm btn-outline-primary' href='pages/editar.php?id={$r['id']}'><i class='bi bi-pencil-square me-1'></i>Editar</a>
                <a class='btn btn-sm btn-outline-danger' href='actions/deletar.php?id={$r['id']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'><i class='bi bi-trash me-1'></i>Excluir</a>
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>