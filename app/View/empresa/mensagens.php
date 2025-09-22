<?php 
    // Caminho para a pasta de views
    $pathView = __DIR__ . '/../../View/';

    // Inclui o cabeçalho dinâmico da área da empresa
    require_once $pathView . 'empresa/comuns/empresa_cabecalho.php'; 

    // Pega o nome da empresa da sessão para usar no corpo da página
    $nomeEmpresa = Core\Library\Session::get('usuario_logado')['nome_fantasia'] ?? Core\Library\Session::get('usuario_logado')['login'] ?? 'Empresa';
?>

<!-- CSS Específico para a página de Mensagens -->
<style>
    .conversation-list {
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .conversation-list:hover {
        background-color: #f8f9fa;
    }
    .message-container {
        display: none;
    }
    .message-container.active-conversation {
        display: block;
    }
</style>

<!-- Main Content -->
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="position-relative mx-auto mb-3">
                        <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Logo da Empresa" class="company-logo border border-3 border-white shadow">
                    </div>
                    <h4 class="mb-1"><?= htmlspecialchars($nomeEmpresa) ?></h4>
                    <p class="text-muted mb-3">Tecnologia e Inovação</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary">TI</span>
                        <span class="badge bg-primary">Desenvolvimento</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary">Completar Perfil</a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="list-group list-group-flush">
                    <a href="<?= baseUrl() ?>empresa/index" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="<?= baseUrl() ?>empresa/vagas" class="list-group-item list-group-item-action">
                        <i class="fas fa-briefcase me-2"></i> Minhas Vagas
                    </a>
                    <a href="<?= baseUrl() ?>empresa/candidatos" class="list-group-item list-group-item-action">
                        <i class="fas fa-users me-2"></i> Candidatos
                    </a>
                    <a href="<?= baseUrl() ?>empresa/mensagens" class="list-group-item list-group-item-action active">
                        <i class="fas fa-envelope me-2"></i> Mensagens
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-cog me-2"></i> Configurações
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-lg-9">
            <!-- Header -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-0">Mensagens</h2>
                    <p class="text-muted mb-0">Selecione uma conversa para visualizar as mensagens.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <!-- Conversations List -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="h5 mb-3">Conversas</h3>
                            
                            <!-- Conversation Item 1 -->
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action" onclick="showConversation('conversation1'); return false;">
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/med/men/32.jpg" alt="Candidato" class="rounded-circle me-3" width="50">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1">João Silva</h6>
                                                <small class="text-muted">Hoje</small>
                                            </div>
                                            <p class="text-muted mb-0 small">Olá, gostaria de mais informações...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Message Container (hidden by default) -->
                    <div id="conversation1" class="message-container card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/med/men/32.jpg" alt="Candidato" class="rounded-circle me-3" width="45">
                                    <div>
                                        <h4 class="h6 mb-0">João Silva</h4>
                                        <small class="text-muted">Candidato à vaga de Desenvolvedor Front-end</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="hideConversation()">
                                    <i class="fas fa-arrow-left me-1"></i> Voltar
                                </button>
                            </div>

                            <!-- Message Thread -->
                            <div class="message-thread mb-4" style="height: 400px; overflow-y: auto;">
                                <!-- Message from Candidate -->
                                <div class="d-flex mb-3">
                                    <img src="https://randomuser.me/api/portraits/med/men/32.jpg" alt="Candidato" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <div>
                                        <div class="bg-light p-3 rounded-3">
                                            <p class="mb-0">Olá, gostaria de mais informações sobre o processo seletivo para a vaga de Desenvolvedor Front-end. Qual seria o próximo passo?</p>
                                        </div>
                                        <small class="text-muted">João Silva - Hoje, 10:30</small>
                                    </div>
                                </div>

                                <!-- Message from Company -->
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="text-end">
                                        <div class="bg-primary text-white p-3 rounded-3">
                                            <p class="mb-0">Olá João, obrigado pelo seu interesse. Vamos agendar uma entrevista técnica para a próxima semana. Qual sua disponibilidade?</p>
                                        </div>
                                        <small class="text-muted">Você - Hoje, 11:15</small>
                                    </div>
                                    <img src="https://img.freepik.com/vetores-premium/logotipo-da-empresa-de-tecnologia-moderna_23-2148465042.jpg" alt="Empresa" class="rounded-circle ms-2" style="width: 40px; height: 40px;">
                                </div>
                            </div>

                            <!-- Reply Box -->
                            <div class="border-top pt-3">
                                <form>
                                    <div class="input-group">
                                        <textarea class="form-control" rows="2" placeholder="Digite sua mensagem..."></textarea>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <!-- Placeholder for when no conversation is selected -->
                    <div id="no-conversation-selected" class="card shadow-sm">
                         <div class="card-body text-center d-flex justify-content-center align-items-center" style="height: 600px;">
                            <div>
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Selecione uma conversa</h5>
                                <p class="text-muted">Suas mensagens com os candidatos aparecerão aqui.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para controlar a exibição das conversas -->
<script>
    const conversationContainer = document.getElementById('conversation1');
    const noConversationPlaceholder = document.getElementById('no-conversation-selected');

    function showConversation(conversationId) {
        noConversationPlaceholder.style.display = 'none'; // Esconde o placeholder
        
        // Esconde outras conversas se houver
        document.querySelectorAll('.message-container').forEach(el => {
            el.classList.remove('active-conversation');
        });
        
        // Mostra a conversa selecionada
        const activeConversation = document.getElementById(conversationId);
        activeConversation.classList.add('active-conversation');
        
        // Em telas menores, esconde a lista de conversas
        if (window.innerWidth < 768) {
            document.querySelector('.col-md-4').style.display = 'none';
        }
    }
    
    function hideConversation() {
        document.querySelectorAll('.message-container').forEach(el => {
            el.classList.remove('active-conversation');
        });

        noConversationPlaceholder.style.display = 'block'; // Mostra o placeholder
        
        // Em telas menores, mostra a lista de conversas novamente
        if (window.innerWidth < 768) {
            document.querySelector('.col-md-4').style.display = 'block';
        }
    }
    
    // Garante que o placeholder seja mostrado inicialmente
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.querySelector('.message-container.active-conversation')) {
            noConversationPlaceholder.style.display = 'block';
             conversationContainer.style.display = 'block'; // Garante que o container existe no DOM
             conversationContainer.classList.remove('active-conversation');
        }
    });
</script>

<?php 
    // Inclui o rodapé global
    require_once $pathView . 'comuns/rodape.php'; 
?>
