<?php
require_once __DIR__ . '/includes/functions.php'; // Usa __DIR__ para caminho seguro
require_once __DIR__ . '/includes/db_connect.php'; // Necessário para verificar duplicados e inserir

// --- 1. Validação de Método ---
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect('/register.php');
    exit;
}

// --- 2. Obter e Sanitizar Dados ---
$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)); // Sanitiza primeiro
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

// Armazena dados para preencher formulário em caso de erro (exceto senhas)
$_SESSION['old_data'] = ['username' => $username, 'email' => $email];

// --- 3. Validação Server-Side ---
$errors = [];
if (empty($username)) { $errors[] = "Nome de usuário é obrigatório."; }
// Validar formato do email APÓS sanitizar
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Email inválido."; }
if (empty($password)) { $errors[] = "Senha é obrigatória."; }
elseif (strlen($password) < 8) { $errors[] = "Senha deve ter no mínimo 8 caracteres."; }
if ($password !== $password_confirm) { $errors[] = "As senhas não coincidem."; }

// --- 4. Verificar se Usuário/Email já existe (NECESSITA DB!) ---
if (empty($errors)) {
    try {
        $db = Database::getConnection();

        // Verifica email
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetch()) {
            $errors[] = "Este email já está cadastrado.";
        }

        // Verifica usuário
        $stmt = $db->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetch()) {
            $errors[] = "Este nome de usuário já está em uso.";
        }

    } catch (PDOException $e) {
        $errors[] = "Erro ao verificar usuário. Tente novamente."; // Mensagem genérica
        // Logar $e->getMessage() para debug do admin
    }
}

// --- 5. Se não houver erros, TENTAR criar usuário ---
if (empty($errors)) {
    // Gerar Hash da Senha (IMPORTANTE!)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if ($password_hash === false) {
        $errors[] = "Erro crítico ao processar a senha."; // Falha no hashing
    } else {
        try {
            // *** CÓDIGO PARA INSERIR NO BANCO DE DADOS VIRIA AQUI ***
            $stmt = $db->prepare("INSERT INTO users (username, email, password_hash, created_at) VALUES (:username, :email, :password_hash, NOW())");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $password_hash);

            if ($stmt->execute()) {
                // Sucesso! Limpa dados antigos e redireciona
                clear_old_data();
                $_SESSION['register_success'] = "Conta criada com sucesso! Faça o login.";
                redirect('/login.php');
                exit;
            } else {
                $errors[] = "Não foi possível criar a conta. Tente novamente.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao salvar no banco de dados. Tente novamente."; // Mensagem genérica
             // Logar $e->getMessage()
        }
    }
}

// --- 6. Se houver erros, voltar para o registro ---
if (!empty($errors)) {
    $_SESSION['register_errors'] = $errors;
    redirect('/register.php');
    exit;
}

?>