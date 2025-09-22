<?php 
// Extrai as variáveis para facilitar o uso na view
$usuario = $dados['usuario'] ?? [];
$curriculum = $dados['curriculum'] ?? [];
$escolaridades = $dados['escolaridades'] ?? [];
$experiencias = $dados['experiencias'] ?? [];
$qualificacoes = $dados['qualificacoes'] ?? [];
$niveis_escolaridade = $dados['niveis_escolaridade'] ?? [];

// Inclui o cabeçalho da área do candidato
include_once __DIR__ . "/comuns/candidato_cabecalho.php"; 
?>

<div class="container-fluid py-4">
    <div class="row">
        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <div class="col-lg-9">
            
            <!-- Mensagens de Feedback -->
            <?php 
            if ($msg = \Core\Library\Session::get('mensagem_sucesso')) {
                echo "<div class='alert alert-success'>{$msg}</div>";
                \Core\Library\Session::destroy('mensagem_sucesso');
            }
            if ($msg = \Core\Library\Session::get('mensagem_erro')) {
                echo "<div class='alert alert-danger'>{$msg}</div>";
                \Core\Library\Session::destroy('mensagem_erro');
            }
            ?>

            <!-- INÍCIO DO FORMULÁRIO ÚNICO -->
            <form action="<?= baseUrl() ?>candidatos/salvarCurriculoCompleto" method="post">
                <input type="hidden" name="curriculum_id" value="<?= $curriculum['curriculum_id'] ?? '' ?>">

                <!-- Card Dados Pessoais e Endereço -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light"><h5 class="mb-0">Meu Currículo</h5></div>
                    <div class="card-body">
                        <h6 class="text-primary mb-3">Dados Pessoais</h6>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Nome Completo</label><input type="text" class="form-control" value="<?= htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']) ?>" disabled></div>
                            <div class="col-md-6"><label class="form-label">CPF</label><input type="text" class="form-control" value="<?= htmlspecialchars($usuario['cpf'] ?? '') ?>" disabled></div>
                            <div class="col-md-4"><label class="form-label">Data de Nascimento</label><input type="date" class="form-control" name="dataNascimento" value="<?= htmlspecialchars($curriculum['dataNascimento'] ?? '') ?>"></div>
                            <div class="col-md-4"><label class="form-label">Sexo</label><select class="form-select" name="sexo"><option value="">Selecione...</option><option value="M" <?= ($curriculum['sexo'] ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option><option value="F" <?= ($curriculum['sexo'] ?? '') == 'F' ? 'selected' : '' ?>>Feminino</option></select></div>
                            <div class="col-md-4"><label class="form-label">Celular</label><input type="text" class="form-control" name="celular" value="<?= htmlspecialchars($curriculum['celular'] ?? '') ?>"></div>
                        </div>
                        <hr class="my-4">
                        <h6 class="text-primary mb-3">Endereço</h6>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label">CEP</label><input type="text" class="form-control" name="cep" value="<?= htmlspecialchars($curriculum['cep'] ?? '') ?>"></div>
                            <div class="col-md-8"><label class="form-label">Logradouro</label><input type="text" class="form-control" name="logradouro" value="<?= htmlspecialchars($curriculum['logradouro'] ?? '') ?>"></div>
                            <div class="col-md-4"><label class="form-label">Número</label><input type="text" class="form-control" name="numero" value="<?= htmlspecialchars($curriculum['numero'] ?? '') ?>"></div>
                            <div class="col-md-8"><label class="form-label">Complemento</label><input type="text" class="form-control" name="complemento" value="<?= htmlspecialchars($curriculum['complemento'] ?? '') ?>"></div>
                            <div class="col-md-6"><label class="form-label">Bairro</label><input type="text" class="form-control" name="bairro" value="<?= htmlspecialchars($curriculum['bairro'] ?? '') ?>"></div>
                            <div class="col-md-4"><label class="form-label">Cidade</label><input type="text" class="form-control" name="cidade" value="<?= htmlspecialchars($curriculum['cidade'] ?? '') ?>" required></div>
                            <div class="col-md-2"><label class="form-label">UF</label><input type="text" class="form-control" name="uf" value="<?= htmlspecialchars($curriculum['uf'] ?? '') ?>" maxlength="2" required></div>
                        </div>
                        <hr class="my-4">
                        <h6 class="text-primary mb-3">Apresentação e Links</h6>
                        <div class="mb-3"><label class="form-label">Apresentação Pessoal</label><textarea class="form-control" name="apresentacaoPessoal" rows="5" placeholder="Fale um pouco sobre você, suas habilidades e objetivos..."><?= htmlspecialchars($curriculum['apresentacaoPessoal'] ?? '') ?></textarea></div>
                        <div class="mb-3"><label class="form-label">Objetivo Profissional</label><input type="text" class="form-control" name="objetivo" value="<?= htmlspecialchars($curriculum['objetivo'] ?? '') ?>" placeholder="Ex: Desenvolvedor Full-Stack Sênior"></div>
                    </div>
                </div>

                <!-- Card Escolaridade -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Escolaridade</h5>
                        <button type="button" id="add-escolaridade" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Adicionar</button>
                    </div>
                    <div class="card-body" id="escolaridade-container">
                        <?php foreach ($escolaridades as $key => $item): ?>
                            <div class="item-block p-3 border rounded mb-3">
                                <input type="hidden" name="escolaridade[<?= $key ?>][curriculum_escolaridade_id]" value="<?= $item['curriculum_escolaridade_id'] ?>">
                                <h6 class="mb-3">Formação</h6>
                                <div class="row g-3">
                                    <div class="col-md-6"><label class="form-label">Nível</label><select name="escolaridade[<?= $key ?>][escolaridade_id]" class="form-select">...options...</select></div>
                                    <div class="col-md-6"><label class="form-label">Curso</label><input type="text" name="escolaridade[<?= $key ?>][descricao]" value="<?= htmlspecialchars($item['descricao']) ?>" class="form-control"></div>
                                    <div class="col-12"><label class="form-label">Instituição</label><input type="text" name="escolaridade[<?= $key ?>][instituicao]" value="<?= htmlspecialchars($item['instituicao']) ?>" class="form-control"></div>
                                </div>
                                <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Card Experiência Profissional -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Experiência Profissional</h5>
                        <button type="button" id="add-experiencia" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Adicionar</button>
                    </div>
                    <div class="card-body" id="experiencia-container">
                        <?php foreach ($experiencias as $key => $item): ?>
                            <div class="item-block p-3 border rounded mb-3">
                                <input type="hidden" name="experiencia[<?= $key ?>][curriculum_experiencia_id]" value="<?= $item['curriculum_experiencia_id'] ?>">
                                <h6 class="mb-3">Experiência</h6>
                                <div class="row g-3">
                                    <div class="col-md-6"><label class="form-label">Cargo</label><input type="text" name="experiencia[<?= $key ?>][cargoDescricao]" value="<?= htmlspecialchars($item['cargoDescricao']) ?>" class="form-control"></div>
                                    <div class="col-md-6"><label class="form-label">Empresa</label><input type="text" name="experiencia[<?= $key ?>][estabelecimento]" value="<?= htmlspecialchars($item['estabelecimento']) ?>" class="form-control"></div>
                                </div>
                                <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Card Qualificações e Cursos -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Qualificações e Cursos</h5>
                        <button type="button" id="add-qualificacao" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Adicionar</button>
                    </div>
                    <div class="card-body" id="qualificacao-container">
                        <?php foreach ($qualificacoes as $key => $item): ?>
                            <div class="item-block p-3 border rounded mb-3">
                                <input type="hidden" name="qualificacao[<?= $key ?>][curriculum_qualificacao_id]" value="<?= $item['curriculum_qualificacao_id'] ?>">
                                <h6 class="mb-3">Qualificação</h6>
                                <div class="row g-3">
                                    <div class="col-md-6"><label class="form-label">Curso/Descrição</label><input type="text" name="qualificacao[<?= $key ?>][descricao]" value="<?= htmlspecialchars($item['descricao']) ?>" class="form-control"></div>
                                    <div class="col-md-6"><label class="form-label">Instituição</label><input type="text" name="qualificacao[<?= $key ?>][estabelecimento]" value="<?= htmlspecialchars($item['estabelecimento']) ?>" class="form-control"></div>
                                    <div class="col-12"><label class="form-label">Carga Horária</label><input type="number" name="qualificacao[<?= $key ?>][cargaHoraria]" value="<?= htmlspecialchars($item['cargaHoraria']) ?>" class="form-control"></div>
                                </div>
                                <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Botão de Salvar Tudo -->
                <div class="card">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-lg btn-success">Salvar Alterações no Currículo</button>
                    </div>
                </div>

            </form>
            <!-- FIM DO FORMULÁRIO ÚNICO -->
        
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let escolaridadeIndex = <?= count($escolaridades) ?>;
    let experienciaIndex = <?= count($experiencias) ?>;
    let qualificacaoIndex = <?= count($qualificacoes) ?>;

    const niveisEscolaridadeOptions = `<?= json_encode($niveis_escolaridade) ?>`;
    const escolaridadeOptionsHtml = JSON.parse(niveisEscolaridadeOptions).map(nivel => `<option value="${nivel.escolaridade_id}">${nivel.descricao}</option>`).join('');

    // Template para nova escolaridade
    const escolaridadeTemplate = (index) => `
        <div class="item-block p-3 border rounded mb-3">
            <h6 class="mb-3 text-primary">Nova Formação</h6>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nível</label><select name="escolaridade[${index}][escolaridade_id]" class="form-select"><option value="">Selecione</option>${escolaridadeOptionsHtml}</select></div>
                <div class="col-md-6"><label class="form-label">Curso</label><input type="text" name="escolaridade[${index}][descricao]" class="form-control"></div>
                <div class="col-12"><label class="form-label">Instituição</label><input type="text" name="escolaridade[${index}][instituicao]" class="form-control"></div>
            </div>
            <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
        </div>`;

    // Template para nova experiência
    const experienciaTemplate = (index) => `
        <div class="item-block p-3 border rounded mb-3">
            <h6 class="mb-3 text-primary">Nova Experiência</h6>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Cargo</label><input type="text" name="experiencia[${index}][cargoDescricao]" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Empresa</label><input type="text" name="experiencia[${index}][estabelecimento]" class="form-control"></div>
            </div>
            <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
        </div>`;

    // Template para nova qualificação
    const qualificacaoTemplate = (index) => `
        <div class="item-block p-3 border rounded mb-3">
            <h6 class="mb-3 text-primary">Nova Qualificação</h6>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Curso/Descrição</label><input type="text" name="qualificacao[${index}][descricao]" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Instituição</label><input type="text" name="qualificacao[${index}][estabelecimento]" class="form-control"></div>
                 <div class="col-12"><label class="form-label">Carga Horária</label><input type="number" name="qualificacao[${index}][cargaHoraria]" class="form-control"></div>
            </div>
            <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-danger remove-item">Remover</button></div>
        </div>`;

    // Adicionar listeners
    document.getElementById('add-escolaridade').addEventListener('click', () => {
        document.getElementById('escolaridade-container').insertAdjacentHTML('beforeend', escolaridadeTemplate(escolaridadeIndex++));
    });

    document.getElementById('add-experiencia').addEventListener('click', () => {
        document.getElementById('experiencia-container').insertAdjacentHTML('beforeend', experienciaTemplate(experienciaIndex++));
    });

    document.getElementById('add-qualificacao').addEventListener('click', () => {
        document.getElementById('qualificacao-container').insertAdjacentHTML('beforeend', qualificacaoTemplate(qualificacaoIndex++));
    });

    // Listener para remover (delegação de evento)
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.item-block').remove();
        }
    });

     // Preencher selects de escolaridade existentes
    document.querySelectorAll('#escolaridade-container select').forEach(select => {
        const selectedValue = select.dataset.selected;
        select.innerHTML = `<option value="">Selecione</option>${escolaridadeOptionsHtml}`;
        if(selectedValue) {
            select.value = selectedValue;
        }
    });
});
</script>

<?php include_once __DIR__ . "/comuns/candidato_rodape.php"; ?>
