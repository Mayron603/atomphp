<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Conecta Muriaé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Seu CSS personalizado -->
    <link rel="stylesheet" href="<?= baseUrl() ?>assets/css/style.css">
</head>
<body>
    <!-- Formulário de Cadastro -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold">Crie sua conta</h2>
                                <p class="text-muted">Comece sua jornada profissional conosco</p>
                            </div>

                            <?php if (isset($msgError)):
 ?>
                                <div class="alert alert-danger"><?= $msgError ?></div>
                            <?php elseif (isset($msgSuccess)):
 ?>
                                <div class="alert alert-success"><?= $msgSuccess ?></div>
                            <?php endif; ?>

                            <form action="<?= baseUrl() ?>login/registrar" method="POST">
                                <!-- Tipo de conta -->
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo de Conta*</label>
                                    <select class="form-select" id="tipo" name="tipo" required>
                                        <option value="" disabled selected>Selecione...</option>
                                        <option value="CN">Sou Candidato (Contribuinte Normativo)</option>
                                        <option value="A">Sou Empresa (Anunciante)</option>
                                        <option value="G">Sou Gestor</option>
                                    </select>
                                </div>

                                <!-- Nome e CPF -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nome" class="form-label">Nome Completo*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cpf" class="form-label">CPF*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- E-mail (login) -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail*</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                         <input type="text" class="form-control" id="login" name="login" placeholder="Seu login" required>
                                    </div>
                                </div>

                                <!-- Estabelecimento (somente se tipo = A ou G) -->
                                <div id="estabelecimentoFields" class="d-none">
                                    <h5 class="mt-3">Dados da Empresa</h5>
                                    <div class="mb-3">
                                        <label for="estabelecimento_nome" class="form-label">Nome da Empresa*</label>
                                        <input type="text" class="form-control" id="estabelecimento_nome" name="estabelecimento_nome" placeholder="Nome da empresa">
                                    </div>
                                    <div class="mb-3">
                                        <label for="estabelecimento_endereco" class="form-label">Endereço*</label>
                                        <input type="text" class="form-control" id="estabelecimento_endereco" name="estabelecimento_endereco" placeholder="Endereço da empresa">
                                    </div>
                                    <div class="mb-3">
                                        <label for="estabelecimento_email" class="form-label">E-mail da Empresa*</label>
                                        <input type="email" class="form-control" id="estabelecimento_email" name="estabelecimento_email" placeholder="empresa@email.com">
                                    </div>
                                </div>

                                <!-- Senha -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="senha" class="form-label">Senha*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="confirmar_senha" class="form-label">Confirmar Senha*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme a senha" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Eu concordo com os <a href="#">Termos de Serviço</a> e <a href="#">Política de Privacidade</a>
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary py-2">Criar conta</button>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted">Já tem uma conta? <a href="<?= baseUrl() ?>login" class="text-decoration-none">Faça login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar campos de estabelecimento quando tipo = A ou G
        document.getElementById('tipo').addEventListener('change', function() {
            let estFields = document.getElementById('estabelecimentoFields');
            if (this.value === 'A' || this.value === 'G') {
                estFields.classList.remove('d-none');
            } else {
                estFields.classList.add('d-none');
            }
        });
    </script>
</body>
</html>