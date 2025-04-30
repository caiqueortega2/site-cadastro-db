<?php
$page_title = "Meu Perfil";
require_once 'includes/header.php';

// Protege a página: verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_error'] = ["Você precisa fazer login para acessar esta página."];
    redirect('/login.php');
    exit;
}
?>

<h1>Meu Perfil</h1>
<hr>

<p>Bem-vindo(a), <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
<p>Seu ID de usuário é: <?php echo $_SESSION['user_id']; ?></p>
<p>Seu email cadastrado é: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>

<div class="mt-4">
    <a href="#" class="btn btn-secondary">Editar Perfil</a> <a href="logout.php" class="btn btn-danger">Sair</a>
</div>


<?php
require_once 'includes/footer.php';
?>