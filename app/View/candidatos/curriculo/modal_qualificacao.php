<!-- Modal Adicionar/Editar Qualificação -->
<div class="modal fade" id="modalQualificacao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= baseUrl() ?>candidatos/salvarQualificacao" method="post">
                <input type="hidden" name="curriculum_qualificacao_id" id="formQualificacaoId">
                <input type="hidden" name="curriculum_curriculum_id" value="<?= $curriculoId ?>">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalQualificacaoLabel">Adicionar Qualificação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Curso/Descrição</label><input type="text" name="descricao" id="formQualificacaoDescricao" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Instituição</label><input type="text" name="estabelecimento" id="formQualificacaoInstituicao" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Carga Horária (horas)</label><input type="number" name="cargaHoraria" id="formQualificacaoCarga" class="form-control" required></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
