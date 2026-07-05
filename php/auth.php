<?php
/**
 * Authentication Functions
 * Handles login, logout, and session management
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

class Auth {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Admin Login
     */
    public function adminLogin($username, $password) {
        $username = sanitize($username);
        
        $stmt = $this->db->prepare('SELECT id, username, email, password, role, status FROM admins WHERE username = ? OR email = ?');
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        $admin = $result->fetch_assoc();
        
        if ($admin['status'] === 'inactive') {
            return ['success' => false, 'message' => 'Account is inactive'];
        }
        
        if (!verifyPassword($password, $admin['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Set session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_role'] = $admin['role'];
        
        // Update last login
        $updateStmt = $this->db->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?');
        $updateStmt->bind_param('i', $admin['id']);
        $updateStmt->execute();
        
        return ['success' => true, 'message' => 'Login successful'];
    }

    /**
     * User Login
     */
    public function userLogin($email, $password) {
        $email = sanitize($email);
        
        if (!isValidEmail($email)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }
        
        $stmt = $this->db->prepare('SELECT id, email, password, first_name, status FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        $user = $result->fetch_assoc();
        
        if ($user['status'] === 'inactive') {
            return ['success' => false, 'message' => 'Account is inactive'];
        }
        
        if (!verifyPassword($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['first_name'];
        
        return ['success' => true, 'message' => 'Login successful'];
    }

    /**
     * User Register
     */
    public function userRegister($firstName, $lastName, $email, $phone, $password, $confirmPassword) {
        // Validation
        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
            return ['success' => false, 'message' => 'All fields are required'];
        }
        
        if ($password !== $confirmPassword) {
            return ['success' => false, 'message' => 'Passwords do not match'];
        }
        
        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }
        
        if (!isValidEmail($email)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }
        
        if (!isValidPhone($phone)) {
            return ['success' => false, 'message' => 'Invalid phone number'];
        }
        
        // Check if email exists
        $stmt = $this->db->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return ['success' => false, 'message' => 'Email already registered'];
        }
        
        // Create user
        $firstName = sanitize($firstName);
        $lastName = sanitize($lastName);
        $email = sanitize($email);
        $phone = sanitize($phone);
        $hashedPassword = hashPassword($password);
        
        $stmt = $this->db->prepare('INSERT INTO users (first_name, last_name, email, phone, password, status) VALUES (?, ?, ?, ?, ?, "active")');
        $stmt->bind_param('sssss', $firstName, $lastName, $email, $phone, $hashedPassword);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Registration successful. Please login.'];
        }
        
        return ['success' => false, 'message' => 'Registration failed. Please try again.'];
    }

    /**
     * Logout
     */
    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }

    /**
     * Check if user is logged in
     */
    public function isLoggedIn() {
        return isset($_SESSION['admin_id']) || isset($_SESSION['user_id']);
    }
}

// Prevent direct access and initialize
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    header('HTTP/1.0 403 Forbidden');
    exit('Access Denied');
}
