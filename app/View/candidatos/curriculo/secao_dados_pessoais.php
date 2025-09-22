<!-- Card Dados Principais -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Dados Principais</h5>
    </div>
    <div class="card-body">
        <form action="<?= baseUrl() ?>candidatos/salvarCurriculo" method="post">
            <!-- Campo oculto para o ID, para saber se é uma edição -->
            <?php if (!empty($curriculum['curriculum_id'])): ?>
                <input type="hidden" name="curriculum_id" value="<?= $curriculum['curriculum_id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="objetivo" class="form-label">Objetivo Profissional</label>
                <input type="text" class="form-control" id="objetivo" name="objetivo" value="<?= htmlspecialchars($curriculum['objetivo'] ?? '') ?>" required placeholder="Ex: Desenvolvedor Full-Stack Sênior">
            </div>

            <div class="mb-3">
                <label for="resumo" class="form-label">Resumo Profissional</label>
                <textarea class="form-control" id="resumo" name="resumo" rows="4" placeholder="Fale um pouco sobre sua trajetória, suas principais habilidades e o que você busca na sua carreira."><?= htmlspecialchars($curriculum['resumo'] ?? '') ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="linkedin" class="form-label">Perfil LinkedIn</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= htmlspecialchars($curriculum['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/in/seu-perfil">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="github" class="form-label">Perfil GitHub</label>
                    <input type="url" class="form-control" id="github" name="github" value="<?= htmlspecialchars($curriculum['github'] ?? '') ?>" placeholder="https://github.com/seu-usuario">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="portfolio" class="form-label">Portfólio / Site Pessoal</label>
                <input type="url" class="form-control" id="portfolio" name="portfolio" value="<?= htmlspecialchars($curriculum['portfolio'] ?? '') ?>" placeholder="https://seusite.com">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Salvar Dados Principais</button>
            </div>
        </form>
    </div>
</div>
