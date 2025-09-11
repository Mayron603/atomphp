<?php include_once __DIR__ . "/comuns/candidato_cabecalho.php"; ?>

<div class="container-fluid py-4">
    <div class="row">
        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Minhas Candidaturas</h2>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Todas</a></li>
                                <li><a class="dropdown-item" href="#">Em análise</a></li>
                                <li><a class="dropdown-item" href="#">Visualizadas</a></li>
                                <li><a class="dropdown-item" href="#">Aprovadas</a></li>
                                <li><a class="dropdown-item" href="#">Reprovadas</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-muted mb-4">Acompanhe o status de todas as suas candidaturas.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Vaga</th>
                                    <th>Empresa</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CORREÇÃO: Trocado $aDados por $dados -->
                                <?php if (empty($dados['candidaturas'])): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Você ainda não se candidatou a nenhuma vaga.</p>
                                            <a href="<?= baseUrl() ?>vagas" class="btn btn-primary mt-3">Buscar Vagas</a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <!-- CORREÇÃO: Trocado $aDados por $dados -->
                                    <?php foreach ($dados['candidaturas'] as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="rounded-circle bg-primary bg-opacity-10" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-briefcase text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-0"><?= htmlspecialchars($item['vaga']['descricao']) ?></h6>
                                                        <small class="text-muted"><?= htmlspecialchars($item['vaga']['vinculo']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($item['empresa']['nome']) ?></td>
                                            <td><?= date("d/m/Y", strtotime($item['candidatura']['dtCriacao'])) ?></td>
                                            <td>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($item['candidatura']['status']) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= baseUrl() ?>vagas/visualizar/<?= $item['vaga']['vaga_id'] ?>" class="btn btn-sm btn-outline-primary">Detalhes</a>
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

<?php include_once __DIR__ . "/comuns/candidato_rodape.php"; ?>
