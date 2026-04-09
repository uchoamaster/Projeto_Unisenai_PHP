<?php
// ------------------------------------------------------------
// ARQUIVO: includes/header.php
// RESPONSABILIDADE:
// Iniciar a estrutura HTML padrao (head, navbar e abertura do main).
// Todas as paginas incluem este arquivo para reaproveitar layout.
// ------------------------------------------------------------

// Titulo padrao caso a pagina nao defina um titulo proprio.
if (!isset($pageTitle)) {
    $pageTitle = 'CRUD de Usuarios';
}

// Item ativo padrao do menu.
if (!isset($activePage)) {
  $activePage = 'crud';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--
    htmlspecialchars protege o titulo contra caracteres especiais.
    ENT_QUOTES converte aspas simples e duplas para entidades HTML.
  -->
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

  <!-- Bootstrap CSS e Bootstrap Icons via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
  <!-- Navbar principal do projeto -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="index.php">
        <i class="bi bi-people-fill me-2"></i>CRUD Usuarios
      </a>

      <!-- Botao hamburguer exibido em telas pequenas -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Alternar navegacao">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu colapsavel -->
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <!-- Classe active depende da pagina aberta -->
            <a class="nav-link <?php echo $activePage === 'crud' ? 'active' : ''; ?>" href="index.php">
              <i class="bi bi-table me-1"></i>CRUD
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $activePage === 'aprendizado' ? 'active' : ''; ?>" href="aprendizado.php">
              <i class="bi bi-journal-code me-1"></i>Aprendizado
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteudo especifico de cada pagina -->
  <main class="container py-4">
