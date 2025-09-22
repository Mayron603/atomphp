<!-- Modal Adicionar/Editar Escolaridade -->
<div class="modal fade" id="modalEscolaridade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= baseUrl() ?>candidatos/salvarEscolaridade" method="post">
                <!-- Campo oculto para o ID da escolaridade (para edição) -->
                <input type="hidden" name="curriculum_escolaridade_id" id="formEscolaridadeId">
                <input type="hidden" name="curriculum_curriculum_id" value="<?= $curriculoId ?>">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEscolaridadeLabel">Adicionar Formação Acadêmica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nível de Escolaridade</label>
                        <select name="escolaridade_id" id="formEscolaridadeNivel" class="form-select" required>
                            <option value="">Selecione o nível</option>
                            <?php foreach ($niveis_escolaridade as $nivel): ?>
                                <option value="<?= $nivel['escolaridade_id'] ?>"><?= htmlspecialchars($nivel['descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Curso</label><input type="text" name="descricao" id="formEscolaridadeCurso" class="form-control" required placeholder="Ex: Bacharelado em Ciência da Computação"></div>
                    <div class="mb-3"><label class="form-label">Instituição de Ensino</label><input type="text" name="instituicao" id="formEscolaridadeInstituicao" class="form-control" required placeholder="Ex: Universidade Federal de..."></div>
                    <div class="row mb-3">
                        <div class="col-md-8"><label class="form-label">Cidade da Instituição</label><input type="text" name="cidade" id="formEscolaridadeCidade" class="form-control" required></div>
                        <div class="col-md-4"><label class="form-label">UF</label><input type="text" name="uf" id="formEscolaridadeUf" class="form-control" maxlength="2" required></div>
                    </div>
                    <div class="row">
                        <label class="form-label">Período</label>
                        <div class="col-sm-3"><input type="number" name="inicioMes" id="formEscolaridadeInicioMes" class="form-control" placeholder="Mês Início" min="1" max="12" required></div>
                        <div class="col-sm-3"><input type="number" name="inicioAno" id="formEscolaridadeInicioAno" class="form-control" placeholder="Ano Início" required></div>
                        <div class="col-sm-3"><input type="number" name="fimMes" id="formEscolaridadeFimMes" class="form-control" placeholder="Mês Fim" min="1" max="12"></div>
                        <div class="col-sm-3"><input type="number" name="fimAno" id="formEscolaridadeFimAno" class="form-control" placeholder="Ano Fim"></div>
                        <div class="form-text">Preencha Mês/Ano de Fim apenas se já concluiu.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
