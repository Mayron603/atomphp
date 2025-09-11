<?php 
include_once __DIR__ . "/comuns/candidato_cabecalho.php"; 

$usuario = $dados['usuario'] ?? [];
$curriculum = $dados['curriculum'] ?? [];

// Buscar telefone principal se existir
$telefone = '';
if (!empty($usuario['pessoa_fisica_id'])) {
    $telefoneModel = new \App\Model\TelefoneModel();
    $telefoneDados = $telefoneModel->getTelefonePrincipal($usuario['pessoa_fisica_id']);
    if ($telefoneDados) {
        $telefone = $telefoneDados['numero'];
    }
}

?>

<div class="container-fluid py-4">
    <div class="row">

        <?php include_once __DIR__ . "/comuns/sidebar.php"; ?>

        <div class="col-lg-9">
            <div class="card shadow-sm settings-card">
                <div class="card-body">
                    <div class="settings-header">
                        <h2 class="h4 mb-2">Configurações da Conta</h2>
                        <p class="text-muted mb-0">Gerencie suas informações pessoais, preferências e configurações de privacidade.</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="nav flex-column nav-pills me-3" id="settings-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                                    <i class="fas fa-user-circle me-2"></i> Perfil
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content" id="settings-tabContent">
                                <!-- Perfil Tab -->
                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                    <h4 class="mb-4">Informações do Perfil</h4>
                                    
                                    <form method="POST" action="<?= baseUrl() ?>candidatos/salvarConfiguracoes">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="sobrenome" class="form-label">Sobrenome</label>
                                                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?= htmlspecialchars($usuario['sobrenome'] ?? '') ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['login'] ?? '') ?>" disabled>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($telefone) ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="resumo_profissional" class="form-label">Resumo Profissional</label>
                                            <textarea class="form-control" id="resumo_profissional" name="resumo_profissional" rows="3"><?= htmlspecialchars($curriculum['apresentacaoPessoal'] ?? '') ?></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include_once __DIR__ . "/comuns/candidato_rodape.php"; 
?>
