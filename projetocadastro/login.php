<?php
$page_title = "Login";
require_once 'includes/header.php';

// Se já estiver logado, redireciona para o perfil
if (isset($_SESSION['user_id'])) {
    redirect('/profile.php');
}
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <h1 class="text-center mb-4">Login</h1>

        <?php display_session_message('login_error'); ?>
        <?php display_session_message('register_success'); // Mostra msg se veio do registro ?>

        <form id="login-form" action="process_login.php" method="POST" novalidate>
             <div class="mb-3">
                <label for="email" class="form-label">Email ou Nome de Usuário <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email_or_username" name="email_or_username" value="<?php echo old_value('email_or_username'); ?>" required>
                 <div class="invalid-feedback">Campo obrigatório.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required>
                 <div class="invalid-feedback">Campo obrigatório.</div>
            </div>
             <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                <label class="form-check-label" for="remember_me">Lembrar-me</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
            </div>
            <p class="mt-3 text-center"><a href="#">Esqueceu a senha?</a></p> </form>
         <p class="mt-3 text-center">Não tem uma conta? <a href="register.php">Cadastre-se</a></p>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>