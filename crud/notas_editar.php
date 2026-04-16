<?php
// ------------------------------------------------------------
// ARQUIVO: notas_editar.php
// RESPONSABILIDADE:
// Buscar lancamento de nota por id e exibir formulario preenchido.
// Exercicio 11 (bonus).
// ------------------------------------------------------------

include 'conexao.php';

$id = $_GET['id'] ?? '';

if (filter_var($id, FILTER_VALIDATE_INT) === false) {
  header('Location: notas_index.php?status=error&msg=' . urlencode('ID invalido.'));
  exit;
}

$stmt = mysqli_prepare($conn, "SELECT * FROM notas_alunos WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dados = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$dados) {
  header('Location: notas_index.php?status=error&msg=' . urlencode('Lancamento nao encontrado.'));
  exit;
}

$pageTitle = 'Editar Notas';
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
        <h2 class="h5 mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Notas</h2>
      </div>
      <div class="card-body">
        <form method="POST" action="notas_atualizar.php" class="row g-3">
          <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

          <div class="col-12 col-md-6">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select id="aluno_id" class="form-select" name="aluno_id" required>
              <option value="">Selecione...</option>
              <?php while ($a = mysqli_fetch_assoc($alunos)): ?>
                <option value="<?php echo $a['id']; ?>" <?php echo $a['id'] == $dados['aluno_id'] ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($a['nome'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label for="bimestre" class="form-label">Bimestre</label>
            <select id="bimestre" class="form-select" name="bimestre" required>
              <option value="">Selecione...</option>
              <?php
              $bimestres = ['1o Bimestre', '2o Bimestre', '3o Bimestre', '4o Bimestre'];
              foreach ($bimestres as $b): ?>
                <option value="<?php echo $b; ?>" <?php echo $dados['bimestre'] === $b ? 'selected' : ''; ?>>
                  <?php echo $b; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota1" class="form-label">Nota 1</label>
            <input id="nota1" class="form-control" type="number" step="0.01" min="0" max="10" name="nota1" value="<?php echo $dados['nota1']; ?>" required>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota2" class="form-label">Nota 2</label>
            <input id="nota2" class="form-control" type="number" step="0.01" min="0" max="10" name="nota2" value="<?php echo $dados['nota2']; ?>" required>
          </div>

          <div class="col-12 col-md-4">
            <label for="nota3" class="form-label">Nota 3</label>
            <input id="nota3" class="form-control" type="number" step="0.01" min="0" max="10" name="nota3" value="<?php echo $dados['nota3']; ?>" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="peso" class="form-label">Peso</label>
            <input id="peso" class="form-control" type="number" step="0.01" min="0" name="peso" value="<?php echo $dados['peso']; ?>" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="faltas" class="form-label">Faltas</label>
            <input id="faltas" class="form-control" type="number" min="0" name="faltas" value="<?php echo $dados['faltas']; ?>" required>
          </div>

          <div class="col-12 d-flex justify-content-between">
            <a href="notas_index.php" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left me-1"></i>Voltar
            </a>
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-save me-1"></i>Atualizar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
