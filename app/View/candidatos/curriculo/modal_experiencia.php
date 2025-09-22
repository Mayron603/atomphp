<!-- Modal Adicionar/Editar Experiência -->
<div class="modal fade" id="modalExperiencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= baseUrl() ?>candidatos/salvarExperiencia" method="post">
                <input type="hidden" name="curriculum_experiencia_id" id="formExperienciaId">
                <input type="hidden" name="curriculum_curriculum_id" value="<?= $curriculoId ?>">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExperienciaLabel">Adicionar Experiência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Cargo</label><input type="text" name="cargoDescricao" id="formExperienciaCargo" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Empresa</label><input type="text" name="estabelecimento" id="formExperienciaEmpresa" class="form-control" required></div>
                     <div class="row">
                        <div class="col-6"><label class="form-label">Ano de Início</label><input type="number" name="inicioAno" id="formExperienciaInicioAno" class="form-control" required></div>
                        <div class="col-6"><label class="form-label">Ano de Fim</label><input type="number" name="fimAno" id="formExperienciaFimAno" class="form-control" placeholder="Deixe em branco se for o atual"></div>
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
