<?php
// ------------------------------------------------------------
// ARQUIVO: form.php
// RESPONSABILIDADE:
// Exibir formulario para cadastro de novo usuario.
// ------------------------------------------------------------

// Define titulo da pagina e inclui layout base.
$pageTitle = 'Novo Usuario';
include 'includes/header.php';

// Mensagens de feedback vindas da pagina salvar.php.
$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';
?>

<div class="row justify-content-center">
  <div class="col-12 col-md-9 col-lg-7">
    <?php // Exibe alerta de sucesso/erro, quando houver mensagem. ?>
    <?php if ($msg !== ''): ?>
      <?php $isSuccess = $status === 'success'; ?>
      <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show d-flex align-items-start shadow-sm" role="alert">
        <i class="bi <?php echo $isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2 mt-1"></i>
        <div><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
      </div>
    <?php endif; ?>

    <!-- Card principal do formulario -->
    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h2 class="h5 mb-0"><i class="bi bi-person-plus me-2"></i>Novo Usuario</h2>
      </div>
      <div class="card-body">
        <!-- Envia os dados via POST para salvar.php -->
        <form method="POST" action="salvar.php" class="row g-3">
          <div class="col-12">
            <label for="nome" class="form-label">Nome</label>
            <!-- required ativa validacao nativa no navegador -->
            <input id="nome" class="form-control" type="text" name="nome" >
          </div>

          <div class="col-12 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" >
          </div>

          <div class="col-12 col-md-6">
            <label for="telefone" class="form-label">Telefone</label>
            <input id="telefone" class="form-control" type="text" name="telefone" >
          </div>

          <div class="col-12 col-md-4">
            <label for="idade" class="form-label">Idade</label>
            <input id="idade" class="form-control" type="number" min="1" name="idade" >
          </div>

          <div class="col-12 col-md-8">
            <label for="cidade" class="form-label">Cidade</label>
            <input id="cidade" class="form-control" type="text" name="cidade" >
          </div>

          <div class="col-12">
            <label for="curso" class="form-label">Curso</label>
            <input id="curso" class="form-control" type="text" name="curso" >
          </div>

          <div class="col-12 d-flex justify-content-between">
            <!-- Volta para listagem sem enviar formulario -->
            <a href="index.php" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left me-1"></i>Voltar
            </a>

            <!-- Botao que envia o formulario -->
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-check-circle me-1"></i>Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php // Fecha o layout com footer. ?>
<?php include 'includes/footer.php'; ?>