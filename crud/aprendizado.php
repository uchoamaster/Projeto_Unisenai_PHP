<?php
// ------------------------------------------------------------
// ARQUIVO: aprendizado.php
// RESPONSABILIDADE:
// Pagina de apoio didatico com resumo do projeto e dos conceitos.
// ------------------------------------------------------------

// Define titulo e item ativo do menu.
$pageTitle = 'Resumo do Projeto';
$activePage = 'aprendizado';

// Inclui layout base (head, navbar e abertura do main).
include 'includes/header.php';
?>

<!-- Bloco HERO com resumo principal -->
<section class="mb-4">
  <div class="p-4 p-md-5 bg-white border rounded-3 shadow-sm">
    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
      <span class="badge text-bg-primary"><i class="bi bi-mortarboard-fill me-1"></i>Projeto Individual</span>
      <span class="badge text-bg-success"><i class="bi bi-check2-circle me-1"></i>Em evolucao</span>
    </div>
    <h1 class="display-6 fw-bold mb-3">O que estamos aprendendo neste CRUD em PHP</h1>
    <p class="lead mb-3">Este projeto pratica fundamentos de desenvolvimento web com PHP, MySQL e interface responsiva com Bootstrap 5.</p>
    <div class="d-flex flex-wrap gap-2">
      <a href="index.php" class="btn btn-primary">
        <i class="bi bi-play-circle me-1"></i>Ver CRUD em acao
      </a>
      <button class="btn btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStack" aria-controls="offcanvasStack">
        <i class="bi bi-diagram-3 me-1"></i>Stack do Projeto
      </button>
    </div>
  </div>
</section>

<!-- Cards com pilares de aprendizado -->
<section class="row g-3 mb-4">
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100 border-0 shadow-sm">
      <div class="card-body">
        <i class="bi bi-filetype-php fs-2 text-primary"></i>
        <h2 class="h6 mt-2">PHP Basico</h2>
        <p class="mb-0 text-muted">Fluxo de paginas, includes e captura de dados via formularios.</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100 border-0 shadow-sm">
      <div class="card-body">
        <i class="bi bi-database-fill-check fs-2 text-success"></i>
        <h2 class="h6 mt-2">MySQL</h2>
        <p class="mb-0 text-muted">Operacoes de inserir, listar, atualizar e excluir usuarios.</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100 border-0 shadow-sm">
      <div class="card-body">
        <i class="bi bi-grid-1x2-fill fs-2 text-warning"></i>
        <h2 class="h6 mt-2">Bootstrap 5</h2>
        <p class="mb-0 text-muted">Layout responsivo com cards, tabelas, formularios e navegacao.</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100 border-0 shadow-sm">
      <div class="card-body">
        <i class="bi bi-shield-check fs-2 text-danger"></i>
        <h2 class="h6 mt-2">Boas praticas</h2>
        <p class="mb-0 text-muted">Organizacao de layout em header/footer e uso de escape de saida.</p>
      </div>
    </div>
  </div>
</section>

<!-- Secao em duas colunas: resumo + FAQ -->
<section class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-white">
        <h2 class="h6 mb-0"><i class="bi bi-list-check me-2"></i>Resumo do Projeto</h2>
      </div>
      <div class="card-body">
        <div class="alert alert-info d-flex align-items-start" role="alert">
          <i class="bi bi-info-circle-fill me-2 mt-1"></i>
          <div>Este CRUD foi desenvolvido para fixar a base de sistemas web: formulario, persistencia em banco e operacoes de manutencao de dados.</div>
        </div>

        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Cadastro de usuarios
            <span class="badge text-bg-success rounded-pill"><i class="bi bi-check-lg"></i></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Edicao e exclusao
            <span class="badge text-bg-success rounded-pill"><i class="bi bi-check-lg"></i></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Layout organizado em includes
            <span class="badge text-bg-success rounded-pill"><i class="bi bi-check-lg"></i></span>
          </li>
        </ul>

        <h3 class="h6">Progresso de aprendizado</h3>
        <div class="mb-2">
          <div class="d-flex justify-content-between"><span>PHP + Formularios</span><span>85%</span></div>
          <div class="progress" role="progressbar" aria-label="PHP" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-primary" style="width: 85%"></div>
          </div>
        </div>
        <div class="mb-2">
          <div class="d-flex justify-content-between"><span>MySQL + CRUD</span><span>80%</span></div>
          <div class="progress" role="progressbar" aria-label="MySQL" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 80%"></div>
          </div>
        </div>
        <div>
          <div class="d-flex justify-content-between"><span>Bootstrap 5</span><span>75%</span></div>
          <div class="progress" role="progressbar" aria-label="Bootstrap" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-warning text-dark" style="width: 75%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-white">
        <h2 class="h6 mb-0"><i class="bi bi-lightbulb me-2"></i>Perguntas Frequentes</h2>
      </div>
      <div class="card-body">
        <div class="accordion" id="faqProjeto">
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                Qual o objetivo principal?
              </button>
            </h3>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqProjeto">
              <div class="accordion-body">Construir uma base solida em CRUD web com PHP e MySQL, aplicando interface moderna.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                O que foi melhorado no layout?
              </button>
            </h3>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqProjeto">
              <div class="accordion-body">Header e footer reutilizaveis, menu de navegacao e padrao visual com componentes Bootstrap.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                Qual o proximo passo?
              </button>
            </h3>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqProjeto">
              <div class="accordion-body">Adicionar validacoes no backend, mensagens de sucesso/erro e seguranca com prepared statements.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tabela com plano individual de evolucao -->
<section class="card shadow-sm mb-4">
  <div class="card-header bg-white">
    <h2 class="h6 mb-0"><i class="bi bi-kanban me-2"></i>Plano Individual de Evolucao</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Etapa</th>
            <th>Descricao</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><i class="bi bi-1-circle me-1"></i>Estrutura</td>
            <td>Separar layout em includes e padronizar telas.</td>
            <td><span class="badge text-bg-success">Concluida</span></td>
          </tr>
          <tr>
            <td><i class="bi bi-2-circle me-1"></i>UX</td>
            <td>Melhorar feedback visual para cadastro, edicao e exclusao.</td>
            <td><span class="badge text-bg-warning text-dark">Em andamento</span></td>
          </tr>
          <tr>
            <td><i class="bi bi-3-circle me-1"></i>Seguranca</td>
            <td>Aplicar validacoes e consultas parametrizadas.</td>
            <td><span class="badge text-bg-secondary">Planejada</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Offcanvas para mostrar stack do projeto -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasStack" aria-labelledby="offcanvasStackLabel">
  <div class="offcanvas-header">
    <h2 class="offcanvas-title h5" id="offcanvasStackLabel"><i class="bi bi-layers me-2"></i>Stack Tecnologica</h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p class="mb-2">Ferramentas aplicadas neste projeto:</p>
    <ul class="list-group">
      <li class="list-group-item"><i class="bi bi-filetype-php me-2 text-primary"></i>PHP</li>
      <li class="list-group-item"><i class="bi bi-database me-2 text-success"></i>MySQL</li>
      <li class="list-group-item"><i class="bi bi-bootstrap-fill me-2 text-primary"></i>Bootstrap 5</li>
      <li class="list-group-item"><i class="bi bi-stars me-2 text-warning"></i>Bootstrap Icons</li>
    </ul>
  </div>
</div>

<?php // Fecha o layout com footer. ?>
<?php include 'includes/footer.php'; ?>
