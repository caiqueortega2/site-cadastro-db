<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/db_connect.php';

// --- 1. Validação de Método ---
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect('/login.php');
    exit;
}

// --- 2. Obter e Sanitizar Dados ---
// Permite login com email ou username
$email_or_username = trim(filter_input(INPUT_POST, 'email_or_username', FILTER_SANITIZE_SPECIAL_CHARS));
$password = $_POST['password'] ?? '';

// Guarda o input para preencher em caso de erro
$_SESSION['old_data'] = ['email_or_username' => $email_or_username];

// --- 3. Validação Básica ---
$errors = [];
if (empty($email_or_username)) { $errors[] = "Email ou nome de usuário é obrigatório."; }
if (empty($password)) { $errors[] = "Senha é obrigatória."; }

// --- 4. Se dados básicos ok, tentar buscar usuário ---
if (empty($errors)) {
    try {
        $db = Database::getConnection();

        // Prepara query para buscar por email OU username
        $sql = "SELECT id, username, email, password_hash FROM users WHERE email = :identifier OR username = :identifier LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':identifier', $email_or_username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Busca como array associativo

        // --- 5. Verificar se usuário existe E se a senha bate ---
        if ($user && password_verify($password, $user['password_hash'])) {
            // Login bem-sucedido!
            clear_old_data(); // Limpa o email/user do campo

            // Regenera o ID da sessão para segurança
            session_regenerate_id(true);

            // Armazena dados do usuário na sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_email'] = $user['email']; // Pode ser útil

            // Redireciona para o perfil ou dashboard
            redirect('/profile.php');
            exit;

        } else {
            // Usuário não encontrado OU senha incorreta (mensagem genérica por segurança)
            $errors[] = "Credenciais inválidas.";
        }

    } catch (PDOException $e) {
        $errors[] = "Erro no login. Tente novamente mais tarde."; // Mensagem genérica
        // Logar $e->getMessage()
    }
}

// --- 6. Se houve erros, voltar para o login ---
if (!empty($errors)) {
    $_SESSION['login_error'] = $errors; // Usar chave diferente de registro
    redirect('/login.php');
    exit;
}
?>
