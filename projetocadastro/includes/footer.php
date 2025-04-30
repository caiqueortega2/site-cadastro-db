</main> <footer class="bg-dark text-white text-center p-3 mt-auto">
    <div class="container">
        &copy; <?php echo date('Y'); ?> Portal Cibersegurança. Todos os direitos reservados.
        </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/js/main.js"></script>
</body>
</html>
<?php
// Limpa dados antigos do formulário da sessão no final do carregamento da página
if (isset($_SESSION['old_data'])) {
    unset($_SESSION['old_data']);
}
?>