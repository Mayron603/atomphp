<?php include_once __DIR__ . "/comuns/candidato_cabecalho.php"; ?>

<!-- Main Content -->
<div class="container-fluid py-4">
    <div class="row">
        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <!-- Content Area -->
        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h4 mb-0">Notificações</h2>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-check-circle me-1"></i> Marcar todas como lidas
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt me-1"></i> Limpar todas
                            </button>
                        </div>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <!-- Notificação não lida -->
                        <div class="list-group-item notification-item unread p-3">
                            <div class="d-flex align-items-center">
                                <div class="notification-icon interview">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Convite para entrevista</h5>
                                    <p class="mb-1">Você foi convidado para uma entrevista na Empresa Exemplo para a vaga de Desenvolvedor Web.</p>
                                    <small class="notification-time"><i class="far fa-clock me-1"></i> Hoje, 10:30 AM</small>
                                </div>
                                <div class="ms-3">
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Notificação lida -->
                        <div class="list-group-item notification-item p-3">
                            <div class="d-flex align-items-center">
                                <div class="notification-icon application">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Candidatura atualizada</h5>
                                    <p class="mb-1">Sua candidatura para Analista de Marketing na Tech Solutions foi visualizada.</p>
                                    <small class="notification-time"><i class="far fa-clock me-1"></i> Ontem, 15:45 PM</small>
                                </div>
                                <div class="ms-3">
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Adicione mais notificações aqui -->

                    </div>
                    
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
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

<?php include_once __DIR__ . "/comuns/candidato_rodape.php"; ?>