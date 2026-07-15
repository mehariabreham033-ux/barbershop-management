<?php
$host = "localhost";
$dbname = "kabod_barbershop";
$username = "root";      // default XAMPP username
$password = "";          // default XAMPP password is blank

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
}