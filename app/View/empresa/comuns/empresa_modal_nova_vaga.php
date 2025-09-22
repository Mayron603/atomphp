<!-- Modal Nova Vaga -->
<div class="modal fade" id="novaVagaModal" tabindex="-1" aria-labelledby="novaVagaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= baseUrl() ?>empresa/salvar" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="novaVagaModalLabel">Criar Nova Vaga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="descricao" class="form-label">Título da Vaga*</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="vinculo" class="form-label">Vínculo*</label>
                            <select class="form-select" id="vinculo" name="vinculo" required>
                                <option value="" selected disabled>Selecione...</option>
                                <option value="1">CLT</option>
                                <option value="2">Pessoa Jurídica (PJ)</option>
                            </select>
                        </div>
                        
                         <div class="col-md-6">
                            <label for="modalidade" class="form-label">Modalidade*</label>
                            <select class="form-select" id="modalidade" name="modalidade" required>
                                <option value="" selected disabled>Selecione...</option>
                                <option value="1">Presencial</option>
                                <option value="2">Remoto</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="dtInicio" class="form-label">Data de Início*</label>
                            <input type="date" class="form-control" id="dtInicio" name="dtInicio" required>
                        </div>

                        <div class="col-md-6">
                            <label for="dtFim" class="form-label">Data de Fim*</label>
                            <input type="date" class="form-control" id="dtFim" name="dtFim" required>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="cargo_id" class="form-label">Cargo*</label>
                            <select class="form-select" id="cargo_id" name="cargo_id" required>
                                <option value="" selected disabled>Selecione...</option>
                                <?php if (!empty($cargos)): ?>
                                    <?php foreach ($cargos as $cargo): ?>
                                        <option value="<?= $cargo['cargo_id'] ?>"><?= htmlspecialchars($cargo['descricao']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                     <option value="" disabled>Nenhum cargo encontrado. Verifique o cadastro.</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="sobreaVaga" class="form-label">Sobre a Vaga*</label>
                            <textarea class="form-control" id="sobreaVaga" name="sobreaVaga" rows="5" required></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Publicar Vaga</button>
                </div>
            </form>
        </div>
    </div>
</div>
