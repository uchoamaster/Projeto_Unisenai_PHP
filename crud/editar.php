<?php
// ------------------------------------------------------------
// ARQUIVO: editar.php
// RESPONSABILIDADE:
// Buscar um usuario por id e exibir formulario preenchido.
// ------------------------------------------------------------

// Conexao com banco.
include 'conexao.php';

// Recebe o id pela URL.
$id = $_GET['id'];

// Consulta para carregar os dados atuais do usuario.
$res = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id");
$dados = mysqli_fetch_assoc($res);

// Define titulo da pagina e inclui layout base.
$pageTitle = 'Editar Usuario';
include 'includes/header.php';

// Mensagens de feedback vindas de atualizar.php.
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

    <!-- Card principal do formulario de edicao -->
    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h2 class="h5 mb-0"><i class="bi bi-person-gear me-2"></i>Editar Usuario</h2>
      </div>
      <div class="card-body">
        <!-- Envia os dados atualizados para atualizar.php -->
        <form action="atualizar.php" method="POST" class="row g-3">
          <!-- Campo oculto com o id do usuario -->
          <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

          <div class="col-12">
            <label for="nome" class="form-label">Nome</label>
            <!-- value ja vem preenchido com dados do banco -->
            <input id="nome" class="form-control" type="text" name="nome" value="<?php echo htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($dados['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12 col-md-6">
            <label for="telefone" class="form-label">Telefone</label>
            <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo htmlspecialchars($dados['telefone'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12 col-md-4">
            <label for="idade" class="form-label">Idade</label>
            <input id="idade" class="form-control" type="number" min="1" name="idade" value="<?php echo htmlspecialchars($dados['idade'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12 col-md-8">
            <label for="cidade" class="form-label">Cidade</label>
            <input id="cidade" class="form-control" type="text" name="cidade" value="<?php echo htmlspecialchars($dados['cidade'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12">
            <label for="curso" class="form-label">Curso</label>
            <input id="curso" class="form-control" type="text" name="curso" value="<?php echo htmlspecialchars($dados['curso'], ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>

          <div class="col-12 d-flex justify-content-between">
            <!-- Volta para listagem sem enviar formulario -->
            <a href="index.php" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left me-1"></i>Voltar
            </a>

            <!-- Botao para enviar alteracoes -->
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-save me-1"></i>Atualizar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php // Fecha o layout com footer. ?>
<?php include 'includes/footer.php'; ?>