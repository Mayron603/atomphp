<!-- Card Escolaridade -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Escolaridade</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEscolaridade"><i class="fas fa-plus me-1"></i> Adicionar</button>
    </div>
    <div class="card-body">
        <?php if ($isCurriculoPendente): ?>
            <p class="text-muted fst-italic">Salve seu currículo para poder adicionar sua escolaridade.</p>
        <?php elseif (empty($escolaridades)): ?>
            <p class="text-muted">Nenhuma formação acadêmica cadastrada.</p>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($escolaridades as $item): ?>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><?= htmlspecialchars($item['nivel_descricao']) ?></h6>
                            <p class="mb-1">
                                <strong class="text-primary">Curso:</strong> <?= htmlspecialchars($item['descricao']) ?><br>
                                <strong class="text-primary">Instituição:</strong> <?= htmlspecialchars($item['instituicao']) ?><br>
                                <strong class="text-primary">Período:</strong> 
                                <?= htmlspecialchars($item['inicioMes']) ?>/<?= htmlspecialchars($item['inicioAno']) ?> - 
                                <?php if (!empty($item['fimAno'])): ?>
                                    <?= htmlspecialchars($item['fimMes']) ?>/<?= htmlspecialchars($item['fimAno']) ?>
                                <?php else: ?>
                                    <span class="badge bg-success">Cursando</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="text-nowrap">
                            <button class="btn btn-sm btn-outline-primary me-1 btn-edit-escolaridade" data-id="<?= $item['curriculum_escolaridade_id'] ?>" data-bs-toggle="modal" data-bs-target="#modalEscolaridade"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= baseUrl() ?>candidatos/excluirEscolaridade/<?= $item['curriculum_escolaridade_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta formação?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
