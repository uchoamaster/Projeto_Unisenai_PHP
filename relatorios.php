<?php
include 'conexao.php';

$pageTitle = 'Relatorios';
include 'includes/header.php';

$search = trim($_GET['search'] ?? '');
$curso = trim($_GET['curso'] ?? '');
$cidade = trim($_GET['cidade'] ?? '');

$searchLike = "%{$search}%";

$sql = "
    SELECT id, nome, email, telefone, idade, cidade, curso
    FROM usuarios
    WHERE (? = '' OR nome LIKE ? OR email LIKE ? OR telefone LIKE ?)
      AND (? = '' OR curso = ?)
      AND (? = '' OR cidade = ?)
    ORDER BY nome ASC
";

$stmt = mysqli_prepare($conn, $sql);
$usuarios = [];

if ($stmt) {
    mysqli_stmt_bind_param(
        $stmt,
        'ssssssss',
        $search,
        $searchLike,
        $searchLike,
        $searchLike,
        $curso,
        $curso,
        $cidade,
        $cidade
    );

    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($res)) {
        $usuarios[] = $row;
    }

    mysqli_stmt_close($stmt);
}

$totalUsuarios = count($usuarios);
$somaIdades = 0;
$cursosUnicos = [];

foreach ($usuarios as $usuario) {
    $somaIdades += (int) $usuario['idade'];
    $nomeCurso = trim((string) $usuario['curso']);

    if ($nomeCurso !== '') {
        $cursosUnicos[$nomeCurso] = true;
    }
}

$mediaIdade = $totalUsuarios > 0 ? $somaIdades / $totalUsuarios : 0;
$totalCursos = count($cursosUnicos);
?>

<style>
@media print {
    .navbar,
    footer,
    .no-print {
        display: none !important;
    }

    body {
        background: #fff !important;
    }

    .container {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .card {
        border: 1px solid #ddd !important;
    }
}
</style>

<div class="d-flex align-items-center justify-content-between mb-3 no-print">
    <h2 class="mb-0">Relatorio de Usuarios</h2>
    <button type="button" class="btn btn-primary" onclick="window.print()">
        <i class="bi bi-printer me-1"></i>Emitir (Impressao/PDF)
    </button>
</div>

<form method="GET" action="relatorios.php" class="row g-2 mb-4 no-print">
    <div class="col-12 col-md-4">
        <label for="search" class="form-label">Busca geral</label>
        <input
            type="text"
            id="search"
            name="search"
            class="form-control"
            placeholder="Nome, email ou telefone"
            value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
        >
    </div>
    <div class="col-12 col-md-3">
        <label for="curso" class="form-label">Curso (exato)</label>
        <input
            type="text"
            id="curso"
            name="curso"
            class="form-control"
            placeholder="Ex: ADS"
            value="<?php echo htmlspecialchars($curso, ENT_QUOTES, 'UTF-8'); ?>"
        >
    </div>
    <div class="col-12 col-md-3">
        <label for="cidade" class="form-label">Cidade (exata)</label>
        <input
            type="text"
            id="cidade"
            name="cidade"
            class="form-control"
            placeholder="Ex: Joinville"
            value="<?php echo htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8'); ?>"
        >
    </div>
    <div class="col-12 col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-success w-100">Filtrar</button>
        <a href="relatorios.php" class="btn btn-outline-secondary w-100">Limpar</a>
    </div>
</form>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <small class="text-muted">Total de usuarios</small>
                <h4 class="mb-0"><?php echo $totalUsuarios; ?></h4>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <small class="text-muted">Media de idade</small>
                <h4 class="mb-0"><?php echo number_format($mediaIdade, 1, ',', '.'); ?></h4>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <small class="text-muted">Cursos distintos</small>
                <h4 class="mb-0"><?php echo $totalCursos; ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Idade</th>
                        <th>Cidade</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($totalUsuarios === 0): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Nenhum dado encontrado para os filtros informados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($usuario['telefone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars((string) $usuario['idade'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($usuario['cidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($usuario['curso'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<p class="text-muted small mt-3 mb-0">
    Emissao em <?php echo date('d/m/Y H:i'); ?>.
</p>

<?php include 'includes/footer.php'; ?>
