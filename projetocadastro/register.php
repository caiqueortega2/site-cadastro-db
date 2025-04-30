<?php
$page_title = "Cadastro";
require_once 'includes/header.php'; // Inclui cabeçalho e inicia sessão
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Crie sua Conta</h1>

        <?php display_session_message('register_errors'); // Mostra erros, se houver ?>
        <?php display_session_message('register_success'); // Mostra sucesso, se houver ?>

        <form id="register-form" action="process_register.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo old_value('username'); ?>" required>
                <div class="invalid-feedback">Campo obrigatório.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo old_value('email'); ?>" required>
                 <div class="invalid-feedback">Por favor, insira um email válido.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required minlength="8">
                 <div class="invalid-feedback">A senha deve ter no mínimo 8 caracteres.</div>
                 <small class="form-text text-muted">Mínimo 8 caracteres.</small>
            </div>
             <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Senha <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                <div class="invalid-feedback">As senhas não coincidem.</div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
            </div>
        </form>
        <p class="mt-3 text-center">Já tem uma conta? <a href="login.php">Faça login</a></p>
    </div>
</div>

<?php
require_once 'includes/footer.php'; // Inclui rodapé
?>