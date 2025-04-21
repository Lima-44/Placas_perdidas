<?php
class Database {
    private static $host;
    private static $dbname;
    private static $username;
    private static $password;
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            self::$host = getenv('DB_HOST') ?: 'localhost';
            self::$dbname = getenv('DB_NAME') ?: 'placas';
            self::$username = getenv('DB_USER') ?: 'root';
            self::$password = getenv('DB_PASSWORD') ?: '';
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4",
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect() {
        self::$conn = null;
    }
}
?>