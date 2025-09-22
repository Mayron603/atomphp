<?php 
// Mapa para traduzir o ID do vínculo para texto
$mapaVinculo = [
    '1' => 'CLT',
    '2' => 'PJ',
    '3' => 'Estágio',
    '4' => 'Temporário',
    '5' => 'Freelance'
];
?>

<div class="container-fluid py-4">
    <div class="row">
        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-4">Minhas Candidaturas</h2>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Vaga</th>
                                    <th>Empresa</th>
                                    <th>Data da Candidatura</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($dados['candidaturas'])): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Você ainda não se candidatou a nenhuma vaga.</p>
                                            <a href="<?= baseUrl() ?>vagas" class="btn btn-primary mt-3">Buscar Vagas</a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($dados['candidaturas'] as $item): ?>
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item['vaga']['descricao'] ?? 'Vaga não encontrada') ?></h6>
                                                <!-- CORREÇÃO: Traduzindo o ID do vínculo para texto -->
                                                <small class="text-muted"><?= htmlspecialchars($mapaVinculo[$item['vaga']['vinculo']] ?? 'Não especificado') ?></small>
                                            </td>
                                            <td><?= htmlspecialchars($item['empresa']['nome'] ?? 'Empresa não encontrada') ?></td>
                                            <!-- CORREÇÃO: Usando a chave correta 'dateCandidatura' informada pelo usuário -->
                                            <td><?= !empty($item['candidatura']['dateCandidatura']) ? date("d/m/Y", strtotime($item['candidatura']['dateCandidatura'])) : '<span class="text-muted">N/A</span>' ?></td>
                                            <td>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($item['candidatura']['status_candidatura'] ?? 'Pendente') ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= baseUrl() ?>vagas/visualizar/<?= $item['vaga']['vaga_id'] ?? '#' ?>" class="btn btn-sm btn-outline-primary">Ver Vaga</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
