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
                    <a href="<?= baseUrl() ?>empresa/candidatos" class="list-group-item list-group-item-action">
                        <i class="fas fa-users me-2"></i> Candidatos
                    </a>
                    <a href="<?= baseUrl() ?>empresa/mensagens" class="list-group-item list-group-item-action">
                        <i class="fas fa-envelope me-2"></i> Mensagens
                    </a>
                    <a href="<?= baseUrl() ?>empresa/configuracoes" class="list-group-item list-group-item-action active">
                        <i class="fas fa-cog me-2"></i> Configurações
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-lg-9">
            <!-- Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-0">Configurações da Conta</h2>
                    <p class="text-muted mb-0">Gerencie as configurações da sua conta e preferências.</p>
                </div>
            </div>

            <!-- Settings Tabs -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Perfil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">Segurança</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">Notificações</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="settingsTabsContent">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="companyName" class="form-label">Nome da Empresa</label>
                                        <input type="text" class="form-control" id="companyName" value="<?= htmlspecialchars($nomeEmpresa) ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cnpj" class="form-label">CNPJ</label>
                                        <input type="text" class="form-control" id="cnpj" value="12.345.678/0001-99">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="industry" class="form-label">Setor</label>
                                        <select class="form-select" id="industry">
                                            <option selected>Tecnologia e Inovação</option>
                                            <option>Saúde</option>
                                            <option>Educação</option>
                                            <option>Comércio</option>
                                            <option>Indústria</option>
                                            <option>Serviços</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="companySize" class="form-label">Tamanho da Empresa</label>
                                        <select class="form-select" id="companySize">
                                            <option>Pequena (1-50 funcionários)</option>
                                            <option selected>Média (50-200 funcionários)</option>
                                            <option>Grande (200+ funcionários)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="companyDescription" class="form-label">Descrição da Empresa</label>
                                    <textarea class="form-control" id="companyDescription" rows="4">Somos uma empresa de tecnologia especializada em desenvolvimento de software e soluções inovadoras para negócios digitais.</textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Logo da Empresa</label>
                                    <div class="d-flex align-items-center">
                                        <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Logo da Empresa" class="rounded me-3" style="width: 80px; height: 80px;">
                                        <div>
                                            <input type="file" class="form-control" id="companyLogo">
                                            <small class="text-muted">Formatos aceitos: JPG, PNG (Máx. 2MB)</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Security Tab -->
                        <div class="tab-pane fade" id="security" role="tabpanel">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="currentPassword" class="form-label">Senha Atual</label>
                                        <input type="password" class="form-control" id="currentPassword">
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="newPassword" class="form-label">Nova Senha</label>
                                        <input type="password" class="form-control" id="newPassword">
                                        <small class="text-muted">Mínimo de 8 caracteres</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="confirmPassword" class="form-label">Confirmar Nova Senha</label>
                                        <input type="password" class="form-control" id="confirmPassword">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                                        <label class="form-check-label" for="twoFactorAuth">Autenticação em Dois Fatores</label>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Atualizar Segurança</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Notifications Tab -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel">
                            <form>
                                <h5 class="mb-3">Preferências de Notificação</h5>
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                        <label class="form-check-label" for="emailNotifications">Notificações por E-mail</label>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Tipos de Notificação</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newApplications" checked>
                                            <label class="form-check-label" for="newApplications">Novas candidaturas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="applicationUpdates" checked>
                                            <label class="form-check-label" for="applicationUpdates">Atualizações de candidaturas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="jobExpirations">
                                            <label class="form-check-label" for="jobExpirations">Expiração de vagas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newsletter" checked>
                                            <label class="form-check-label" for="newsletter">Newsletter e atualizações</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Salvar Preferências</button>
                                </div>
                            </form>
                        </div>
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
