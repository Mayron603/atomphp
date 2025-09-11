<?php 
include_once __DIR__ . "/comuns/candidato_cabecalho.php"; 

// Pega os dados do usuário para a saudação
$usuario = $aDados['usuario'] ?? [];
$nome = $usuario['nome'] ?? 'Candidato';

?>

<div class="container-fluid py-4">
    <div class="row">

        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <!-- Content Area -->
        <div class="col-lg-9">
            <!-- Welcome Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Bem-vindo de volta, <?= htmlspecialchars($nome) ?>!</h2>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-sync-alt me-1"></i> Atualizar
                        </button>
                    </div>
                    <p class="text-muted mb-4">Acompanhe suas candidaturas e encontre novas oportunidades.</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card bg-primary bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-25 p-3 rounded me-3">
                                            <i class="fas fa-briefcase text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0">5</h3>
                                            <small class="text-muted">Candidaturas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card bg-success bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-25 p-3 rounded me-3">
                                            <i class="fas fa-calendar-check text-success"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0">1</h3>
                                            <small class="text-muted">Entrevistas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning bg-opacity-10 border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-25 p-3 rounded me-3">
                                            <i class="fas fa-heart text-warning"></i>
                                        </div>
                                        <div>
                                            <h3 class="mb-0">3</h3>
                                            <small class="text-muted">Vagas Salvas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Jobs -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Vagas Recomendadas</h2>
                        <a href="<?= baseUrl() ?>vagas" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                    <p class="text-muted mb-4">Baseado no seu perfil e histórico</p>
                    
                    <div class="row">
                        <!-- Job Card 1 (Exemplo) -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 hover-shadow">
                                <div class="card-body">
                                    <!-- Conteúdo do card de vaga -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Card 2 (Exemplo) -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 hover-shadow">
                                <div class="card-body">
                                    <!-- Conteúdo do card de vaga -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Status das Candidaturas</h2>
                        <a href="<?= baseUrl() ?>candidatos/minhasCandidaturas" class="btn btn-sm btn-outline-primary">Ver histórico</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <!-- Conteúdo da tabela -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/comuns/candidato_rodape.php"; ?>