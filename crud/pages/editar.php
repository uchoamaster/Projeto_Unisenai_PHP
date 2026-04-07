<?php
include '../config/conexao.php';

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id");
$dados = mysqli_fetch_assoc($res);

$pageTitle = 'Editar Usuario';
$basePath = '../';
include '../includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="h4 mb-3"><i class="bi bi-pencil-square me-2"></i>Editar Usuario</h2>

            <form action="../actions/atualizar.php" method="POST" class="row g-3">
              <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

              <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $dados['nome']; ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $dados['email']; ?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" name="telefone" value="<?php echo $dados['telefone']; ?>">
              </div>

              <div class="col-md-2">
                <label class="form-label">Idade</label>
                <input type="number" class="form-control" name="idade" value="<?php echo $dados['idade']; ?>">
              </div>

              <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" name="cidade" value="<?php echo $dados['cidade']; ?>">
              </div>

              <div class="col-md-3">
                <label class="form-label">Curso</label>
                <input type="text" class="form-control" name="curso" value="<?php echo $dados['curso']; ?>">
              </div>

              <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>Atualizar</button>
                <a href="../index.php" class="btn btn-outline-secondary">Voltar</a>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>