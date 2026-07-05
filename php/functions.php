<?php
/**
 * Utility Functions
 * Common functions used throughout the application
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/db.php';

/**
 * Sanitize input
 */
function sanitize($data) {
    $db = Database::getInstance();
    return htmlspecialchars($db->escape(strip_tags(trim($data))), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone
 */
function isValidPhone($phone) {
    return preg_match('/^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,9}$/', $phone);
}

/**
 * Hash password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Check if user is logged in
 */
function isUserLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Get logged-in admin
 */
function getLoggedInAdmin() {
    if (isAdminLoggedIn()) {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM admins WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['admin_id']);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    return null;
}

/**
 * Get logged-in user
 */
function getLoggedInUser() {
    if (isUserLoggedIn()) {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    return null;
}

/**
 * Redirect to URL
 */
function redirect($url) {
    header('Location: ' . $url);
    exit();
}

/**
 * Get all services
 */
function getAllServices() {
    $db = Database::getInstance();
    $result = $db->query('SELECT * FROM services WHERE status = "active" ORDER BY name');
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get service by ID
 */
function getServiceById($id) {
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT * FROM services WHERE id = ? AND status = "active"');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/**
 * Get all barbers
 */
function getAllBarbers() {
    $db = Database::getInstance();
    $result = $db->query('SELECT * FROM barbers WHERE status = "active" ORDER BY first_name');
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get barber by ID
 */
function getBarberById($id) {
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT * FROM barbers WHERE id = ? AND status = "active"');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/**
 * Get all testimonials
 */
function getAllTestimonials() {
    $db = Database::getInstance();
    $result = $db->query('SELECT * FROM testimonials WHERE status = "approved" ORDER BY created_at DESC LIMIT 6');
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get FAQ by category
 */
function getFAQByCategory($category = null) {
    $db = Database::getInstance();
    if ($category) {
        $stmt = $db->prepare('SELECT * FROM faq WHERE status = "active" AND category = ? ORDER BY `order`');
        $stmt->bind_param('s', $category);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        $result = $db->query('SELECT * FROM faq WHERE status = "active" ORDER BY `order`');
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * Get available time slots
 */
function getAvailableSlots($barber_id, $date) {
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT appointment_time FROM appointments WHERE barber_id = ? AND appointment_date = ? AND status != "cancelled"');
    $stmt->bind_param('is', $barber_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $bookedTimes = [];
    while ($row = $result->fetch_assoc()) {
        $bookedTimes[] = $row['appointment_time'];
    }
    
    $allSlots = generateTimeSlots();
    return array_diff($allSlots, $bookedTimes);
}

/**
 * Generate time slots
 */
function generateTimeSlots() {
    $slots = [];
    $start = strtotime('09:00');
    $end = strtotime('17:00');
    
    while ($start <= $end) {
        $slots[] = date('H:i', $start);
        $start += 30 * 60; // 30 minutes interval
    }
    
    return $slots;
}

/**
 * Format date
 */
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

/**
 * Format time
 */
function formatTime($time) {
    return date('g:i A', strtotime($time));
}

/**
 * Format currency
 */
function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

/**
 * Get file extension
 */
function getFileExtension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * Validate image file
 */
function isValidImageFile($file) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = getFileExtension($file['name']);
    
    if (!in_array($ext, $allowed)) {
        return false;
    }
    
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return false;
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
    return in_array($mimeType, $allowedMimes);
}

/**
 * Upload image
 */
function uploadImage($file, $folder = 'general') {
    if (!isValidImageFile($file)) {
        return ['success' => false, 'message' => 'Invalid image file'];
    }
    
    $uploadDir = UPLOAD_PATH . $folder . '/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $fileName = uniqid() . '_' . time() . '.' . getFileExtension($file['name']);
    $filePath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        return ['success' => true, 'filename' => $fileName, 'path' => 'uploads/' . $folder . '/' . $fileName];
    }
    
    return ['success' => false, 'message' => 'Failed to upload image'];
}

/**
 * Create slug from string
 */
function createSlug($string) {
    $string = trim($string);
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

/**
 * Get pagination info
 */
function getPaginationInfo($page, $totalItems, $itemsPerPage = 10) {
    $totalPages = ceil($totalItems / $itemsPerPage);
    $offset = ($page - 1) * $itemsPerPage;
    
    return [
        'page' => $page,
        'totalPages' => $totalPages,
        'offset' => $offset,
        'itemsPerPage' => $itemsPerPage,
        'totalItems' => $totalItems
    ];
}
