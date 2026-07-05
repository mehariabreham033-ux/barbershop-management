<?php
/**
 * File Upload Handler
 * Handles image uploads with validation
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Verify admin is logged in
    if (!isAdminLoggedIn()) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Access denied']);
        exit;
    }

    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'CSRF token validation failed']);
        exit;
    }

    $folder = isset($_POST['folder']) ? sanitize($_POST['folder']) : 'general';
    $result = uploadImage($_FILES['image'], $folder);
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Invalid request']);
