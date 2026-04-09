<?php
// ------------------------------------------------------------
// ARQUIVO: index.php
// RESPONSABILIDADE:
// Listar usuarios cadastrados e oferecer acoes de editar/excluir.
// ------------------------------------------------------------

// Conexao com banco para buscar usuarios.
include 'conexao.php';

// Variavel usada no <title> da pagina (header.php).
$pageTitle = 'Usuarios Cadastrados';

// Inclui topo da pagina (HTML inicial + navbar).
include 'includes/header.php';

// Mensagens de feedback vindas por query string.
$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';
?>

<?php // Exibe alerta de sucesso/erro quando existe mensagem. ?>
<?php if ($msg !== ''): ?>
  <?php $isSuccess = $status === 'success'; ?>
  <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show d-flex align-items-start shadow-sm" role="alert">
    <i class="bi <?php echo $isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2 mt-1"></i>
    <div><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
<?php endif; ?>

<!-- Cabecalho da tela de listagem -->
<div class="d-flex align-items-center justify-content-between mb-3">
  <h2 class="mb-0">Usuarios</h2>

  <!-- Link para tela de cadastro -->
  <a href="form.php" class="btn btn-success">
    <i class="bi bi-plus-circle me-1"></i>Novo
  </a>
</div>

<!-- Card que envolve a tabela -->
<div class="card shadow-sm">
  <div class="card-body p-0">
    <div class="table-responsive">
      <!-- Tabela responsiva com dados dos usuarios -->
      <table class="table table-striped table-hover mb-0 align-middle">
        <thead class="table-light">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Idade</th>
            <th>Cidade</th>
            <th>Curso</th>
            <th class="text-center">Acoes</th>
          </tr>
        </thead>
        <tbody>

<?php
// Busca todos os usuarios da tabela.
$res = mysqli_query($conn, "SELECT * FROM usuarios");

// Percorre cada registro e gera uma linha HTML.
while ($r = mysqli_fetch_assoc($res)){
  echo "<tr>
    <td>" . htmlspecialchars($r['nome'], ENT_QUOTES, 'UTF-8') . "</td>
    <td>" . htmlspecialchars($r['email'], ENT_QUOTES, 'UTF-8') . "</td>
    <td>" . htmlspecialchars($r['telefone'], ENT_QUOTES, 'UTF-8') . "</td>
    <td>" . htmlspecialchars($r['idade'], ENT_QUOTES, 'UTF-8') . "</td>
    <td>" . htmlspecialchars($r['cidade'], ENT_QUOTES, 'UTF-8') . "</td>
    <td>" . htmlspecialchars($r['curso'], ENT_QUOTES, 'UTF-8') . "</td>
    <td class='text-center'>
      <a href='editar.php?id={$r['id']}' class='btn btn-sm btn-outline-primary me-1'>
        <i class='bi bi-pencil-square'></i>
      </a>
      <a href='deletar.php?id={$r['id']}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>
        <i class='bi bi-trash'></i>
      </a>
    </td>
  </tr>";
}

// Observacao didatica:
// htmlspecialchars evita que dados vindos do banco sejam interpretados
// como HTML/JS no navegador.
?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php // Inclui rodape padrao (fecha main, footer e scripts). ?>
<?php include 'includes/footer.php'; ?>