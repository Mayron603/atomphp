<!-- Card Qualificações e Cursos -->
<div class="card shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Qualificações e Cursos</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalQualificacao"><i class="fas fa-plus me-1"></i> Adicionar</button>
    </div>
    <div class="card-body">
        <?php if ($isCurriculoPendente): ?>
            <p class="text-muted fst-italic">Salve seu currículo para poder adicionar suas qualificações.</p>
        <?php elseif (empty($qualificacoes)): ?>
            <p class="text-muted">Nenhuma qualificação ou curso cadastrado.</p>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($qualificacoes as $item): ?>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><?= htmlspecialchars($item['descricao']) ?></h6>
                            <p class="mb-1">
                                <strong class="text-primary">Instituição:</strong> <?= htmlspecialchars($item['estabelecimento']) ?><br>
                                <strong class="text-primary">Carga Horária:</strong> <?= htmlspecialchars($item['cargaHoraria']) ?>h
                            </p>
                        </div>
                        <div class="text-nowrap">
                            <button class="btn btn-sm btn-outline-primary me-1 btn-edit-qualificacao" data-id="<?= $item['curriculum_qualificacao_id'] ?>" data-bs-toggle="modal" data-bs-target="#modalQualificacao"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= baseUrl() ?>candidatos/excluirQualificacao/<?= $item['curriculum_qualificacao_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta qualificação?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
