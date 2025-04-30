<?php
require_once __DIR__ . '/includes/functions.php'; // Para iniciar sessão e ter redirect

// Destroi todos os dados da sessão
$_SESSION = array();

// Se usar cookies de sessão, deleta o cookie também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão
session_destroy();

// Redireciona para a página de login ou home
redirect('/login.php?status=loggedout');
exit;
?>