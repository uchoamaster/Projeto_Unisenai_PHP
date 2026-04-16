<?php
// ------------------------------------------------------------
// ARQUIVO: notas_index.php
// RESPONSABILIDADE:
// Listar notas dos alunos com calculos (Exercicios 5-10).
// ------------------------------------------------------------

include 'conexao.php';

$pageTitle = 'Notas dos Alunos';
$activePage = 'notas';
include 'includes/header.php';

$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';

// Busca todas as notas com JOIN para pegar o nome do aluno.
$sql = "SELECT n.*, u.nome AS aluno_nome
        FROM notas_alunos n
        INNER JOIN usuarios u ON u.id = n.aluno_id
        ORDER BY u.nome, n.bimestre";
$res = mysqli_query($conn, $sql);

// Exercicio 10: Calcular resumo para os cards.
$total_lancamentos = 0;
$maior_media = null;
$menor_media = null;
$soma_medias = 0;
$registros = [];

while ($r = mysqli_fetch_assoc($res)) {
  // Exercicio 5: soma e media simples
  $r['soma_notas']     = $r['nota1'] + $r['nota2'] + $r['nota3'];
  $r['media_simples']  = $r['soma_notas'] / 3;

  // Exercicio 6: media ponderada
  $r['media_ponderada'] = $r['media_simples'] * $r['peso'];

  // Exercicio 7: diferenca para meta 7.0
  $r['diferenca_meta'] = $r['media_simples'] >= 7.0 ? 0 : round(7.0 - $r['media_simples'], 2);

  // Exercicio 8: classificacao
  if ($r['media_simples'] < 5.0 || $r['faltas'] > 10) {
    $r['situacao']     = 'Reprovado';
    $r['situacao_css'] = 'text-bg-danger';
  } elseif ($r['media_simples'] >= 5.0 && $r['media_simples'] < 7.0) {
    $r['situacao']     = 'Recuperacao';
    $r['situacao_css'] = 'text-bg-warning';
  } else {
    // media >= 7.0 e faltas <= 10
    $r['situacao']     = 'Aprovado';
    $r['situacao_css'] = 'text-bg-success';
  }

  // Acumula para resumo
  $media = $r['media_simples'];
  $soma_medias += $media;
  if ($maior_media === null || $media > $maior_media) $maior_media = $media;
  if ($menor_media === null || $media < $menor_media) $menor_media = $media;
  $total_lancamentos++;

  $registros[] = $r;
}

$media_geral = $total_lancamentos > 0 ? $soma_medias / $total_lancamentos : 0;
?>

<?php if ($msg !== ''): ?>
  <?php $isSuccess = $status === 'success'; ?>
  <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show d-flex align-items-start shadow-sm" role="alert">
    <i class="bi <?php echo $isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2 mt-1"></i>
    <div><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
<?php endif; ?>

<!-- Exercicio 10: Cards de resumo -->
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="card text-bg-primary shadow-sm">
      <div class="card-body text-center">
        <h6 class="card-title mb-1">Lancamentos</h6>
        <p class="display-6 fw-bold mb-0"><?php echo $total_lancamentos; ?></p>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card text-bg-success shadow-sm">
      <div class="card-body text-center">
        <h6 class="card-title mb-1">Maior Media</h6>
        <p class="display-6 fw-bold mb-0"><?php echo $maior_media !== null ? number_format($maior_media, 2, ',', '.') : '-'; ?></p>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card text-bg-danger shadow-sm">
      <div class="card-body text-center">
        <h6 class="card-title mb-1">Menor Media</h6>
        <p class="display-6 fw-bold mb-0"><?php echo $menor_media !== null ? number_format($menor_media, 2, ',', '.') : '-'; ?></p>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card text-bg-info shadow-sm">
      <div class="card-body text-center">
        <h6 class="card-title mb-1">Media Geral</h6>
        <p class="display-6 fw-bold mb-0"><?php echo number_format($media_geral, 2, ',', '.'); ?></p>
      </div>
    </div>
  </div>
</div>

<!-- Cabecalho da listagem -->
<div class="d-flex align-items-center justify-content-between mb-3">
  <h2 class="mb-0">Notas dos Alunos</h2>
  <a href="notas_form.php" class="btn btn-success">
    <i class="bi bi-plus-circle me-1"></i>Novo
  </a>
</div>

<!-- Exercicio 9: Tabela de listagem -->
<div class="card shadow-sm">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped table-hover mb-0 align-middle">
        <thead class="table-light">
          <tr>
            <th>Aluno</th>
            <th>Bimestre</th>
            <th>Nota1</th>
            <th>Nota2</th>
            <th>Nota3</th>
            <th>Soma</th>
            <th>Media</th>
            <th>M. Ponderada</th>
            <th>Dif. Meta</th>
            <th>Faltas</th>
            <th>Situacao</th>
            <th class="text-center">Acoes</th>
          </tr>
        </thead>
        <tbody>
<?php if (count($registros) === 0): ?>
          <tr><td colspan="12" class="text-center text-muted py-3">Nenhum lancamento encontrado.</td></tr>
<?php else: ?>
  <?php foreach ($registros as $r): ?>
          <tr>
            <td><?php echo htmlspecialchars($r['aluno_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($r['bimestre'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo number_format($r['nota1'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['nota2'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['nota3'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['soma_notas'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['media_simples'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['media_ponderada'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($r['diferenca_meta'], 2, ',', '.'); ?></td>
            <td><?php echo (int)$r['faltas']; ?></td>
            <td><span class="badge <?php echo $r['situacao_css']; ?>"><?php echo $r['situacao']; ?></span></td>
            <td class="text-center">
              <a href="notas_editar.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="notas_deletar.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
  <?php endforeach; ?>
<?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
