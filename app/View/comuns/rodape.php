    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row footer-content">
                <!-- Coluna Esquerda (Logo/Redes) -->
                <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                    <img src="<?= baseUrl() ?>assets/imagens/logo.png" alt="Descubra Muriaé" class="footer-logo">
                    <p class="footer-text">Conectando talentos e oportunidades em Muriaé.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Coluna Central (Links) -->
                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                    <h3 class="footer-title">Links Rápidos</h3>
                    <a href="<?= baseUrl() ?>vagas" class="footer-link">Vagas</a>
                    <a href="#" class="footer-link">Sobre</a>
                    <a href="#" class="footer-link">Contato</a>
                </div>

                <!-- Coluna Direita (Contato) -->
                <div class="col-lg-4 text-center text-lg-end">
                    <h3 class="footer-title">Fale Conosco</h3>
                    <p class="footer-link"><i class="fas fa-envelope me-2"></i> contato@descubramuriae.com</p>
                    <p class="footer-link"><i class="fas fa-phone me-2"></i> (32) 99999-9999</p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center copyright mt-4">
                <p>&copy; <?= date('Y') ?> Descubra Muriaé. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
