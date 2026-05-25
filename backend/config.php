<?php
// Configuration for Database Connection

define('DB_HOST', 'localhost');
define('DB_NAME', 'jahari_safaris_db');
define('DB_USER', 'root'); // Change for production
define('DB_PASS', ''); // Change for production

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // In production, log the error rather than displaying it to the user.
    error_log("Database Connection Failed: " . $e->getMessage());
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["status" => "error", "message" => "Database connection error."]);
    exit();
}
?>
