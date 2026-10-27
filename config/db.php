<?php
$host     = getenv('DB_HOST') ?: "localhost";
$port     = getenv('DB_PORT') ?: "3306";
$dbname   = getenv('DB_NAME') ?: "henrymart";
$user     = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : (getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "");

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed : " . $e->getMessage());
}
?>