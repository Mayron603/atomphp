<?php include_once __DIR__ . "/comuns/cabecalho.php"; ?>

<!-- Hero Section -->
<section class="hero-section-vagas">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title display-4 fw-bold">Encontre sua próxima oportunidade</h1>
                <p class="hero-subtitle lead">Centenas de vagas disponíveis em Muriaé e região</p>
            </div>
            <div class="col-lg-6">
                <img src="<?= baseUrl() ?>assets/img/footer.png"
                     alt="Pessoas procurando emprego" class="img-fluid hero-img">
            </div>
        </div>
    </div>
</section>

<!-- Barra de Busca -->
<section class="search-section py-4 bg-light">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form id="form-busca" class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" id="input-busca" class="form-control border-start-0" placeholder="Cargo, empresa ou palavra-chave">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="select-local">
                            <option value="" selected>Todas as localidades</option>
                            <option>Muriaé</option>
                            <option>Ubá</option>
                            <option>Cataguases</option>
                            <option>Miraí</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i> Buscar Vagas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Listagem de Vagas -->
<section class="vagas-section py-5">
    <div class="container">
        <div class="row">
            <!-- Filtros -->
            <aside class="col-lg-3 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="mb-0">Filtrar Vagas</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Tipo de Vaga</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="tipo-vaga" id="clt" value="CLT">
                                <label class="form-check-label" for="clt">CLT</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="tipo-vaga" id="pj" value="PJ">
                                <label class="form-check-label" for="pj">PJ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="tipo-vaga" id="estagio" value="Estágio">
                                <label class="form-check-label" for="estagio">Estágio</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Área de Atuação</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="area-atuacao" id="tecnologia" value="Tecnologia">
                                <label class="form-check-label" for="tecnologia">Tecnologia</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="area-atuacao" id="administrativo" value="Administrativo">
                                <label class="form-check-label" for="administrativo">Administrativo</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="area-atuacao" id="vendas" value="Vendas">
                                <label class="form-check-label" for="vendas">Vendas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="area-atuacao" id="saude" value="Saúde">
                                <label class="form-check-label" for="saude">Saúde</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Nível de Experiência</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="experiencia" id="junior" value="Júnior">
                                <label class="form-check-label" for="junior">Júnior</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="experiencia" id="pleno" value="Pleno">
                                <label class="form-check-label" for="pleno">Pleno</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filtro-checkbox" type="checkbox" name="experiencia" id="senior" value="Sênior">
                                <label class="form-check-label" for="senior">Sênior</label>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex">
                            <button type="button" id="btn-limpar" class="btn btn-outline-secondary flex-grow-1">Limpar</button>
                            <button type="button" onclick="filtrarVagas()" class="btn btn-primary flex-grow-1">Aplicar</button>
                        </div>
                    </div>
                </div>
            </aside>
            
            <!-- Lista de Vagas -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold mb-0">
                        <span id="vagas-count">0</span> Vagas Disponíveis
                    </h2>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Ordenar por:</span>
                        <select class="form-select form-select-sm w-auto" id="select-ordem">
                            <option value="recentes">Mais recentes</option>
                            <option value="salario">Melhor remuneração</option>
                        </select>
                    </div>
                </div>
                
                <!-- Container das vagas -->
                <div class="vagas-container"></div>
                
                <!-- Paginação -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Próxima</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<script src="<?= baseUrl() ?>assets/js/vagas.js"></script>

<?php include_once __DIR__ . "/comuns/rodape.php"; ?>