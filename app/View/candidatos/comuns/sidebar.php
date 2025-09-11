<?php

// CORREÇÃO: Trocado $aDados por $dados
$usuario = $dados['usuario'] ?? [];
$nomeCompleto = trim(($usuario['nome'] ?? '') . ' ' . ($usuario['sobrenome'] ?? ''));

?>
<!-- Sidebar -->
<div class="col-lg-3">
    <div class="card shadow-sm mb-4">
        <div class="card-body text-center">
            <div class="position-relative mx-auto mb-3" style="width: 120px; height: 120px;">
                <div class="rounded-circle w-100 h-100 object-cover border border-4 border-white shadow bg-secondary d-flex align-items-center justify-content-center">
                    <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                </div>
                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-2 border-white">
                    <i class="fas fa-check text-white"></i>
                </span>
            </div>
            <h4 class="mb-1"><?= htmlspecialchars($nomeCompleto) ?></h4>
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="badge bg-primary">Habilidade 1</span>
                <span class="badge bg-primary">Habilidade 2</span>
            </div>
            <div class="progress mb-3" style="height: 8px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <a href="<?= baseUrl() ?>candidatos/perfil" class="btn btn-sm btn-primary">Completar Perfil</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
            <a href="<?= baseUrl() ?>candidatos" class="list-group-item list-group-item-action">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="<?= baseUrl() ?>candidatos/curriculo" class="list-group-item list-group-item-action">
                <i class="fas fa-file-alt me-2"></i> Meu Currículo
            </a>
            <a href="<?= baseUrl() ?>candidatos/minhasCandidaturas" class="list-group-item list-group-item-action">
                <i class="fas fa-briefcase me-2"></i> Minhas Candidaturas
            </a>
            <a href="<?= baseUrl() ?>candidatos/notificacoes" class="list-group-item list-group-item-action">
                <i class="fas fa-bell me-2"></i> Notificações
                <span class="badge bg-danger float-end">1</span>
            </a>
            <a href="<?= baseUrl() ?>candidatos/configuracoes" class="list-group-item list-group-item-action">
                <i class="fas fa-cog me-2"></i> Configurações
            </a>
        </div>
    </div>
</div>
