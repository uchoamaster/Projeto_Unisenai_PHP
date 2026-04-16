<?php
// ------------------------------------------------------------
// ARQUIVO: notas_form.php
// RESPONSABILIDADE:
// Exibir formulario para cadastro de notas de alunos.
// Exercicio 4.
// ------------------------------------------------------------

include 'conexao.php';

$pageTitle = 'Cadastrar Notas';
$activePage = 'notas';
include 'includes/header.php';

$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';

// Carrega lista de alunos para o select.
$alunos = mysqli_query($conn, "SELECT id, nome FROM usuarios ORDER BY nome");
?>

<div class="row justify-content-center">
  <div class="col-12 col-md-9 col-lg-7">
    <?php if ($msg !== ''): ?>
      <?php $isSuccess = $status === 'success'; ?>
      <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show d-flex align-items-start shadow-sm" role="alert">
        <i class="bi <?php echo $isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2 mt-1"></i>
        <div><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
      </div>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h2 class="h5 mb-0"><i class="bi bi-mortarboard me-2"></i>Cadastrar Notas</h2>
      </div>
      <div class="card-body">
        <form method="POST" action="notas_salvar.php" class="row g-3">
          <div class="col-12 col-md-6">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select id="aluno_id" class="form-select" name="aluno_id" required>
              <option value="">Selecione...</option>
              <?php while ($a = mysqli_fetch_assoc($alunos)): ?>
                <option value="<?php echo $a['id']; ?>"><?php echo htmlspecialchars($a['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label for="bimestre" class="form-label">Bimestre</label>
            <select id="bimestre" class="form-select" name="bimestre" required>
              <option value="">Selecione...</option>
              <option value="1o Bimestre">1o Bimestre</option>
              <option value="2o Bimestre">2o Bimestre</option>
              <option value="3o Bimestre">3o Bimestre</option>
              <option value="4o Bimestre">4o Bimestre</option>
            </select>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota1" class="form-label">Nota 1</label>
            <input id="nota1" class="form-control" type="number" step="0.01" min="0" max="10" name="nota1" required>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota2" class="form-label">Nota 2</label>
            <input id="nota2" class="form-control" type="number" step="0.01" min="0" max="10" name="nota2" required>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota3" class="form-label">Nota 3</label>
            <input id="nota3" class="form-control" type="number" step="0.01" min="0" max="10" name="nota3" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="peso" class="form-label">Peso</label>
            <input id="peso" class="form-control" type="number" step="0.01" min="0" name="peso" value="1.00" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="faltas" class="form-label">Faltas</label>
            <input id="faltas" class="form-control" type="number" min="0" name="faltas" value="0" required>
          </div>

          <div class="col-12 d-flex justify-content-between">
            <a href="notas_index.php" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left me-1"></i>Voltar
            </a>
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-check-circle me-1"></i>Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
