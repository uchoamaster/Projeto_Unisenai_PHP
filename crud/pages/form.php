<?php
$pageTitle = 'Novo Usuario';
$basePath = '../';
include '../includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <?php if (isset($_GET['erro']) && $_GET['erro'] === 'campos') { ?>
      <div class="alert alert-warning" role="alert">
        Preencha todos os campos obrigatorios.
      </div>
    <?php } ?>

    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="h4 mb-3"><i class="bi bi-person-plus-fill me-2"></i>Novo Usuario</h2>

        <form method="POST" action="../actions/salvar.php" class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">Idade</label>
            <input type="number" class="form-control" min="1" name="idade" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" name="cidade" required>
          </div>

          <div class="col-md-3">
            <label class="form-label">Curso</label>
            <input type="text" class="form-control" name="curso" required>
          </div>

          <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i>Salvar</button>
            <a href="../index.php" class="btn btn-outline-secondary">Voltar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>