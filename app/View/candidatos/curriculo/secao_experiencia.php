<!-- Card Experiência Profissional -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Experiência Profissional</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalExperiencia"><i class="fas fa-plus me-1"></i> Adicionar</button>
    </div>
    <div class="card-body">
        <?php if ($isCurriculoPendente): ?>
            <p class="text-muted fst-italic">Salve seu currículo para poder adicionar suas experiências.</p>
        <?php elseif (empty($experiencias)): ?>
            <p class="text-muted">Nenhuma experiência profissional cadastrada.</p>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($experiencias as $item): ?>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><?= htmlspecialchars($item['cargoDescricao']) ?></h6>
                            <p class="mb-1">
                                <strong class="text-primary">Empresa:</strong> <?= htmlspecialchars($item['estabelecimento']) ?><br>
                                <strong class="text-primary">Período:</strong> 
                                <?= htmlspecialchars($item['inicioAno']) ?> - 
                                <?= $item['fimAno'] ?? '<span class="badge bg-info">Atual</span>' ?>
                            </p>
                        </div>
                        <div class="text-nowrap">
                            <button class="btn btn-sm btn-outline-primary me-1 btn-edit-experiencia" data-id="<?= $item['curriculum_experiencia_id'] ?>" data-bs-toggle="modal" data-bs-target="#modalExperiencia"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= baseUrl() ?>candidatos/excluirExperiencia/<?= $item['curriculum_experiencia_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta experiência?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
