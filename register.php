<?php
header('Content-Type: application/json');
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];
if (empty($name)) $errors[] = "Name is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

try {
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'An account with that email already exists.']);
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hashed]);

    echo json_encode(['status' => 'success', 'message' => 'Account created! You can now log in.']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Registration failed. Try again later.']);
}