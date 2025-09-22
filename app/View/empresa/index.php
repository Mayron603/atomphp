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
                        <!-- Placeholder para o logo -->
                        <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Logo da Empresa" class="company-logo border border-3 border-white shadow" style="width: 120px; height: 120px; object-fit: contain;">
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
                    <a href="<?= baseUrl() ?>empresa/index" class="list-group-item list-group-item-action active">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="<?= baseUrl() ?>empresa/vagas" class="list-group-item list-group-item-action">
                        <i class="fas fa-briefcase me-2"></i> Minhas Vagas
                    </a>
                    <a href="<?= baseUrl() ?>empresa/candidatos" class="list-group-item list-group-item-action">
                        <i class="fas fa-users me-2"></i> Candidatos
                    </a>
                    <a href="<?= baseUrl() ?>empresa/mensagens" class="list-group-item list-group-item-action">
                        <i class="fas fa-envelope me-2"></i> Mensagens
                    </a>
                    <a href="<?= baseUrl() ?>empresa/configuracoes" class="list-group-item list-group-item-action">
                        <i class="fas fa-cog me-2"></i> Configurações
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-lg-9">
            <!-- Welcome Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Bem-vindo, <?= htmlspecialchars($nomeEmpresa) ?>!</h2>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Nova Vaga
                        </button>
                    </div>
                    <p class="text-muted mb-4">Gerencie suas vagas, candidatos e processos seletivos.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card bg-primary bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-25 p-3 rounded me-3">
                                            <i class="fas fa-briefcase text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0"><?= $total_vagas_ativas ?></h3>
                                            <small class="text-muted">Vagas Ativas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-25 p-3 rounded me-3">
                                            <i class="fas fa-users text-success"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0"><?= $total_candidaturas ?></h3>
                                            <small class="text-muted">Candidaturas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Vagas Ativas Recentes</h2>
                        <a href="<?= baseUrl() ?>empresa/vagas" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                    
                    <div class="row">
                        <?php if (empty($vagas_ativas)): ?>
                            <div class="col-12">
                                <p class="text-center text-muted">Nenhuma vaga ativa no momento.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($vagas_ativas as $vaga): ?>
                                <div class="col-md-12 mb-4">
                                    <div class="card h-100 job-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="badge bg-success">Ativa</span>
                                                <small class="text-muted">Publicada em <?= date('d/m/Y', strtotime($vaga['dtInicio'])) ?></small>
                                            </div>
                                            <div class="d-flex align-items-start mb-3">
                                                <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Logo Empresa" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: contain;">
                                                <div>
                                                    <h3 class="h5 mb-1"><?= htmlspecialchars($vaga['cargo_descricao']) ?></h3>
                                                    <p class="text-muted mb-0"><?= htmlspecialchars($nomeEmpresa) ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <span class="badge bg-light text-dark me-1"><i class="fas fa-map-marker-alt text-muted me-1"></i> <?= $vaga['modalidade'] == 1 ? 'Presencial' : 'Remoto' ?></span>
                                                <span class="badge bg-light text-dark me-1"><i class="fas fa-file-contract text-muted me-1"></i> <?= $vaga['vinculo'] == 1 ? 'CLT' : 'Pessoa Jurídica' ?></span>
                                            </div>
                                            
                                            <p class="small text-muted mb-3"><?= htmlspecialchars($vaga['descricao']) ?></p>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <!-- Contagem de candidaturas por vaga (a ser implementado) -->
                                                </div>
                                                <div>
                                                    <a href="<?= baseUrl() ?>empresa/editar/<?= $vaga['vaga_id'] ?>" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                                                    <a href="<?= baseUrl() ?>empresa/candidatos/<?= $vaga['vaga_id'] ?>" class="btn btn-sm btn-primary">Candidatos</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php 
    // Inclui o rodapé global
    require_once $pathView . 'comuns/rodape.php'; 
?>
