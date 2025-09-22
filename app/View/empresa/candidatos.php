<?php 
    // Caminho para a pasta de views
    $pathView = __DIR__ . '/../../View/';

    // Inclui o cabeçalho dinâmico da área da empresa
    require_once $pathView . 'empresa/comuns/empresa_cabecalho.php'; 

    // Pega o nome da empresa da sessão para usar no corpo da página
    $nomeEmpresa = Core\Library\Session::get('usuario_logado')['nome_fantasia'] ?? Core\Library\Session::get('usuario_logado')['login'] ?? 'Empresa';
?>

<!-- Main Content -->
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="position-relative mx-auto mb-3">
                        <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Logo da Empresa" class="company-logo border border-3 border-white shadow">
                    </div>
                    <h4 class="mb-1"><?= htmlspecialchars($nomeEmpresa) ?></h4>
                    <p class="text-muted mb-3">Tecnologia e Inovação</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary">TI</span>
                        <span class="badge bg-primary">Desenvolvimento</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary">Completar Perfil</a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="list-group list-group-flush">
                    <a href="<?= baseUrl() ?>empresa/index" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="<?= baseUrl() ?>empresa/vagas" class="list-group-item list-group-item-action">
                        <i class="fas fa-briefcase me-2"></i> Minhas Vagas
                    </a>
                    <a href="<?= baseUrl() ?>empresa/candidatos" class="list-group-item list-group-item-action active">
                        <i class="fas fa-users me-2"></i> Candidatos
                    </a>
                    <a href="<?= baseUrl() ?>empresa/mensagens" class="list-group-item list-group-item-action">
                        <i class="fas fa-envelope me-2"></i> Mensagens
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-cog me-2"></i> Configurações
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-lg-9">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Candidatos</h1>
                <div class="d-flex">
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-download me-1"></i> Exportar
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filtros
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 300px;" aria-labelledby="filterDropdown">
                            <div class="mb-3">
                                <label for="jobFilter" class="form-label">Vaga</label>
                                <select class="form-select" id="jobFilter">
                                    <option value="all">Todas as vagas</option>
                                    <option value="frontend">Desenvolvedor Front-end</option>
                                    <option value="analista">Analista de Dados</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="statusFilter" class="form-label">Status</label>
                                <select class="form-select" id="statusFilter">
                                    <option value="all">Todos</option>
                                    <option value="analysis">Em análise</option>
                                    <option value="contacted">Contatados</option>
                                    <option value="interview">Entrevista</option>
                                    <option value="hired">Contratados</option>
                                    <option value="rejected">Rejeitados</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dateFilter" class="form-label">Período</label>
                                <select class="form-select" id="dateFilter">
                                    <option value="all">Todos</option>
                                    <option value="week">Última semana</option>
                                    <option value="month">Último mês</option>
                                    <option value="3months">Últimos 3 meses</option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100">Aplicar Filtros</button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Candidates Stats -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card border-0 bg-primary bg-opacity-10 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-25 p-3 rounded me-3">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">1</h3>
                                    <small class="text-muted">Total de Candidatos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card border-0 bg-info bg-opacity-10 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-25 p-3 rounded me-3">
                                    <i class="fas fa-search text-info"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">0</h3>
                                    <small class="text-muted">Em Análise</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card border-0 bg-warning bg-opacity-10 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-25 p-3 rounded me-3">
                                    <i class="fas fa-calendar-check text-warning"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">1</h3>
                                    <small class="text-muted">Entrevistas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-success bg-opacity-10 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-25 p-3 rounded me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">0</h3>
                                    <small class="text-muted">Contratados</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidates Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 30%;">Candidato</th>
                                    <th style="width: 20%;">Vaga</th>
                                    <th style="width: 15%;">Data</th>
                                    <th style="width: 15%;">Status</th>
                                    <th style="width: 20%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Candidate 1 - Interview -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/med/men/32.jpg" alt="Candidato" class="rounded-circle me-3" width="40" height="40">
                                            <div>
                                                <h6 class="mb-0">João Silva</h6>
                                                <small class="text-muted">Desenvolvedor Front-end</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Desenvolvedor Front-end</td>
                                    <td>15/06/2025</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-calendar-check me-1"></i> Entrevista
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#candidateModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="actionsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Ações
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="actionsDropdown1">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-phone me-2"></i>Contatar</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-calendar me-2"></i>Agendar Entrevista</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-success" href="#"><i class="fas fa-check me-2"></i>Aprovar</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-times me-2"></i>Rejeitar</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Próxima</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Candidate Modal -->
<div class="modal fade" id="candidateModal" tabindex="-1" aria-labelledby="candidateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="candidateModalLabel">Perfil do Candidato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-4 text-center">
                        <img src="https://randomuser.me/api/portraits/med/men/32.jpg" alt="Candidato" class="img-fluid rounded-circle mb-3" width="120">
                        <h4>João Silva</h4>
                        <p class="text-muted">Desenvolvedor Front-end</p>
                        
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary">
                                <i class="fas fa-phone me-1"></i> Contatar
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-1"></i> Enviar Mensagem
                            </button>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body text-start">
                                <h6 class="card-title"><i class="fas fa-info-circle me-2"></i>Informações</h6>
                                <ul class="list-unstyled small">
                                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Muriaé, MG</li>
                                    <li class="mb-2"><i class="fas fa-phone me-2"></i> (32) 99999-9999</li>
                                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> joao.silva@email.com</li>
                                    <li class="mb-2"><i class="fas fa-birthday-cake me-2"></i> 28 anos</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body text-start">
                                <h6 class="card-title"><i class="fas fa-file-alt me-2"></i>Documentos</h6>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-secondary text-start">
                                        <i class="fas fa-file-pdf me-2"></i> Currículo.pdf
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary text-start">
                                        <i class="fas fa-file-pdf me-2"></i> Portfólio.pdf
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Sobre</h5>
                                <p>Desenvolvedor Front-end com 5 anos de experiência, especializado em React e Vue.js. Apaixonado por criar interfaces de usuário intuitivas e responsivas.</p>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Experiência Profissional</h5>
                                <div class="mb-3">
                                    <h6 class="mb-1">Desenvolvedor Front-end Sênior</h6>
                                    <p class="small text-muted mb-1">Tech Innovations · 2020 - Presente</p>
                                    <p class="small">Desenvolvimento de aplicações web com React, liderança técnica de equipes e arquitetura de front-end.</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-1">Desenvolvedor Front-end Pleno</h6>
                                    <p class="small text-muted mb-1">Digital Solutions · 2018 - 2020</p>
                                    <p class="small">Implementação de interfaces de usuário e colaboração com equipes de design e back-end.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Formação Acadêmica</h5>
                                <div class="mb-3">
                                    <h6 class="mb-1">Bacharelado em Ciência da Computação</h6>
                                    <p class="small text-muted mb-1">Universidade Federal de Minas Gerais · 2014 - 2018</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-between w-100">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Aprovar
                        </button>
                        <button type="button" class="btn btn-outline-danger">
                            <i class="fas fa-times me-1"></i> Rejeitar
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-calendar me-1"></i> Agendar Entrevista
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    // Inclui o rodapé global
    require_once $pathView . 'comuns/rodape.php'; 
?>
