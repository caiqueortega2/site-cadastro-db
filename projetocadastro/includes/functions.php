<?php
// Inicia a sessão em todas as páginas que incluirem este arquivo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função auxiliar para redirecionamento
function redirect($url) {
    header("Location: " . $url);
    exit;
}

// Função para mostrar erros da sessão e limpá-los
function display_session_message($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]); // Limpa após exibir
        if (is_array($message)) { // Se for array de erros
            echo '<div class="alert alert-danger" role="alert">';
            foreach ($message as $error) {
                echo htmlspecialchars($error) . '<br>';
            }
            echo '</div>';
        } else { // Se for mensagem única (ex: sucesso)
             echo '<div class="alert alert-success" role="alert">';
             echo htmlspecialchars($message);
             echo '</div>';
        }
    }
}

// Função para obter dados antigos do formulário (útil em caso de erro)
function old_value($key, $default = '') {
     if (isset($_SESSION['old_data'][$key])) {
         $value = $_SESSION['old_data'][$key];
         // Não limpa aqui, pode ser necessário em vários campos
         return htmlspecialchars($value);
     }
     return $default;
}

// Limpa os dados antigos depois que o formulário é processado (chamar no final do script do form)
function clear_old_data() {
    unset($_SESSION['old_data']);
}

?>