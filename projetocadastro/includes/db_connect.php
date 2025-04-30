<?php
// ATENÇÃO: Substitua com suas credenciais REAIS do banco de dados!
define('DB_HOST', 'localhost');
define('DB_NAME', 'cybersec_db');      // Mantenha este nome (ou o que você usou em CREATE DATABASE)
define('DB_USER', 'silentxploitt');   // <<< MUDE AQUI para o seu usuário
define('DB_PASS', '@Ca39349684');     // <<< MUDE AQUI para a sua senha

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arrays associativos
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements nativos
            ];

            try {
                self::$connection = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (PDOException $e) {
                // Em produção, logue o erro em vez de exibir
                // error_log("Erro de conexão com DB: " . $e->getMessage());
                // die("Erro de conexão com o banco de dados. Tente novamente mais tarde.");
                // Por enquanto, para facilitar o debug inicial:
                 die("Erro de conexão com DB: " . $e->getMessage() . "<br/>Verifique as credenciais em includes/db_connect.php e se o banco/usuário existem.");
            }
        }
        return self::$connection;
    }
}

// Exemplo de como usar:
// $db = Database::getConnection();
// $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
// $stmt->execute([1]);
// $user = $stmt->fetch();

?>