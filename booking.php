<?php
header('Content-Type: application/json');
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if (empty($name)) $errors[] = "Name is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
if (empty($phone) || !preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) $errors[] = "A valid phone number is required.";

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $message]);

    echo json_encode(['status' => 'success', 'message' => "Thanks $name! Your booking has been received."]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Could not save booking. Please try again later.']);
}