<?php 
$usuario = $dados['usuario'] ?? [];
$curriculum = $dados['curriculum'] ?? [];

include_once __DIR__ . "/comuns/candidato_cabecalho.php"; 
?>

<div class="container-fluid py-4">
    <div class="row">
        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Meu Currículo</h5>
                </div>
                <div class="card-body">

                    <?php 
                    $mensagem_sucesso = \Core\Library\Session::get('mensagem_sucesso');
                    if (!empty($mensagem_sucesso)):
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?= $mensagem_sucesso; ?>
                            <?php \Core\Library\Session::destroy('mensagem_sucesso'); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    $mensagem_erro = \Core\Library\Session::get('mensagem_erro');
                    if (!empty($mensagem_erro)):
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $mensagem_erro; ?>
                            <?php \Core\Library\Session::destroy('mensagem_erro'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= baseUrl() ?>candidatos/salvarCurriculo" method="post">
                        
                        <h6 class="text-primary mb-3">Dados Pessoais</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                       value="<?= htmlspecialchars(($usuario['nome'] ?? '') . ' ' . ($usuario['sobrenome'] ?? '')) ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" 
                                       value="<?= htmlspecialchars($usuario['cpf'] ?? $curriculum['cpf'] ?? '') ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" 
                                       value="<?= htmlspecialchars($curriculum['dataNascimento'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="sexo" name="sexo">
                                    <option value="">Selecione...</option>
                                    <option value="M" <?= (($curriculum['sexo'] ?? '') == 'M') ? 'selected' : '' ?>>Masculino</option>
                                    <option value="F" <?= (($curriculum['sexo'] ?? '') == 'F') ? 'selected' : '' ?>>Feminino</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="celular" class="form-label">Telefone Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" 
                                       value="<?= htmlspecialchars($curriculum['celular'] ?? $usuario['telefone'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($usuario['login'] ?? '') ?>" disabled>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="text-primary mb-3">Endereço</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" 
                                       value="<?= htmlspecialchars($curriculum['cep'] ?? '') ?>">
                            </div>
                            <div class="col-md-8">
                                <label for="logradouro" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro" 
                                       value="<?= htmlspecialchars($curriculum['logradouro'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" 
                                       value="<?= htmlspecialchars($curriculum['numero'] ?? '') ?>">
                            </div>
                            <div class="col-md-8">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" 
                                       value="<?= htmlspecialchars($curriculum['complemento'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" 
                                       value="<?= htmlspecialchars($curriculum['bairro'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" 
                                       value="<?= htmlspecialchars($curriculum['cidade'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-2">
                                <label for="uf" class="form-label">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" 
                                       value="<?= htmlspecialchars($curriculum['uf'] ?? '') ?>" maxlength="2" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="text-primary mb-3">Apresentação Pessoal</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <textarea class="form-control" name="apresentacaoPessoal" rows="5" 
                                          placeholder="Fale um pouco sobre você, suas habilidades e experiências..."><?= htmlspecialchars($curriculum['apresentacaoPessoal'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include_once __DIR__ . "/comuns/candidato_rodape.php"; 
?>
