<?php 
    // Caminho para a pasta de views
    $pathView = __DIR__ . '/../../View/';

    // Inclui o cabeçalho dinâmico da área da empresa, que contém o <head> com os estilos
    require_once $pathView . 'empresa/comuns/empresa_cabecalho.php'; 
?>
<?php
    // O controller passa a variável $dados, que contém o array 'curriculo'.
    $curriculo = $dados['curriculo'] ?? [];
    $escolaridades = $curriculo['escolaridades'] ?? [];
    $experiencias = $curriculo['experiencias'] ?? [];
    $qualificacoes = $curriculo['qualificacoes'] ?? [];

    // Função para formatar a data
    function formatarData($data) {
        if (empty($data) || $data === '0000-00-00') return 'Data não informada';
        try {
            return (new DateTime($data))->format('d/m/Y');
        } catch (Exception $e) {
            return 'Data inválida';
        }
    }
?>

<div class="container-fluid py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 text-dark">Currículo de <?php echo htmlspecialchars($curriculo['nome'] ?? 'Candidato'); ?></h1>
            <a href="javascript:history.back()" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Voltar</a>
        </div>

        <!-- Dados Pessoais -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary"><i class="fas fa-user-tie me-2"></i>Dados Pessoais</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted">Nome Completo</p>
                        <p class="fw-bold"><?php echo htmlspecialchars($curriculo['nome'] ?? 'Não informado'); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted">CPF</p>
                        <p class="fw-bold"><?php echo htmlspecialchars($curriculo['cpf'] ?? 'Não informado'); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted">E-mail</p>
                        <p class="fw-bold"><?php echo htmlspecialchars($curriculo['email'] ?? 'Não informado'); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted">Celular</p>
                        <p class="fw-bold"><?php echo htmlspecialchars($curriculo['celular'] ?? 'Não informado'); ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted">Data de Nascimento</p>
                        <p class="fw-bold"><?php echo formatarData($curriculo['dataNascimento'] ?? null); ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class="mb-1 text-muted">Endereço</p>
                        <p class="fw-bold">
                            <?php 
                                echo htmlspecialchars($curriculo['logradouro'] ?? 'Rua não informada') . ', ' . 
                                     htmlspecialchars($curriculo['numero'] ?? 'S/N') . ' - ' .
                                     htmlspecialchars($curriculo['bairro'] ?? 'Bairro não informado') . ', CEP: ' .
                                     htmlspecialchars($curriculo['cep'] ?? 'CEP não informado');
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Apresentação Pessoal -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary"><i class="fas fa-bullhorn me-2"></i>Apresentação Pessoal</h5>
            </div>
            <div class="card-body p-4">
                <p class="lead">
                    <?php echo nl2br(htmlspecialchars($curriculo['apresentacaoPessoal'] ?? 'Nenhuma apresentação pessoal cadastrada.')); ?>
                </p>
            </div>
        </div>
        
        <!-- Escolaridade -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary"><i class="fas fa-graduation-cap me-2"></i>Escolaridade</h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($escolaridades)):
                    echo '<ul class="list-group list-group-flush">';
                    foreach ($escolaridades as $item):
                ?>
                        <li class="list-group-item px-0">
                            <p class="fw-bold mb-1 fs-5"><?= htmlspecialchars($item['descricao']); ?></p>
                            <p class="mb-1"><i class="fas fa-university me-2 text-muted"></i><?= htmlspecialchars($item['instituicao']); ?></p>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Início: <?= htmlspecialchars($item['inicioAno']); ?> - 
                                Fim: <?= htmlspecialchars($item['fimAno'] ?? 'Cursando'); ?>
                            </p>
                        </li>
                <?php 
                    endforeach;
                    echo '</ul>';
                else: 
                ?>
                    <p class="text-muted">Nenhuma escolaridade cadastrada.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Experiência Profissional -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary"><i class="fas fa-briefcase me-2"></i>Experiência Profissional</h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($experiencias)):
                    echo '<ul class="list-group list-group-flush">';
                    foreach ($experiencias as $item):
                ?>
                     <li class="list-group-item px-0">
                        <p class="fw-bold mb-1 fs-5"><?= htmlspecialchars($item['cargoDescricao']); ?></p>
                        <p class="mb-1"><i class="fas fa-building me-2 text-muted"></i><?= htmlspecialchars($item['estabelecimento']); ?></p>
                        <p class="mb-0 text-muted">
                            <i class="fas fa-calendar-alt me-2"></i>
                            De <?= htmlspecialchars($item['inicioAno']); ?> até <?= htmlspecialchars($item['fimAno'] ?? 'Atual'); ?>
                        </p>
                     </li>
                <?php 
                    endforeach;
                    echo '</ul>';
                else: 
                ?>
                    <p class="text-muted">Nenhuma experiência profissional cadastrada.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Qualificações e Cursos -->
        <div class="card shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary"><i class="fas fa-star me-2"></i>Qualificações e Cursos</h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($qualificacoes)):
                    echo '<ul class="list-group list-group-flush">';
                    foreach ($qualificacoes as $item):
                ?>
                     <li class="list-group-item px-0">
                        <p class="fw-bold mb-1"><?= htmlspecialchars($item['descricao']); ?></p>
                        <p class="mb-1"><i class="fas fa-building me-2 text-muted"></i><?= htmlspecialchars($item['estabelecimento']); ?></p>
                     </li>
                <?php 
                    endforeach;
                    echo '</ul>';
                else: 
                ?>
                    <p class="text-muted">Nenhuma qualificação ou curso cadastrado.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php 
    // Inclui o rodapé global, que contém os scripts JS e fecha as tags </body> e </html>
    require_once $pathView . 'comuns/rodape.php'; 
?>