<?php
/**
 * Contact Form Handler
 * Handles contact form submissions
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

class Contact {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Save contact message
     */
    public function saveMessage($data) {
        // Validation
        if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            return ['success' => false, 'message' => 'Please fill in all required fields'];
        }

        // Validate email
        if (!isValidEmail($data['email'])) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        // Validate phone if provided
        if (!empty($data['phone']) && !isValidPhone($data['phone'])) {
            return ['success' => false, 'message' => 'Invalid phone number'];
        }

        // Check for spam (max 5 messages per hour from same email)
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM contacts WHERE email = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)');
        $stmt->bind_param('s', $data['email']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        if ($result['count'] >= 5) {
            return ['success' => false, 'message' => 'Too many messages. Please try again later.'];
        }

        // Sanitize input
        $name = sanitize($data['name']);
        $email = sanitize($data['email']);
        $phone = !empty($data['phone']) ? sanitize($data['phone']) : null;
        $subject = !empty($data['subject']) ? sanitize($data['subject']) : 'General Inquiry';
        $message = sanitize($data['message']);

        // Insert message
        $stmt = $this->db->prepare('INSERT INTO contacts (name, email, phone, subject, message, status) VALUES (?, ?, ?, ?, ?, "new")');
        $stmt->bind_param('sssss', $name, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            // Send admin notification (optional)
            $this->sendAdminNotification($name, $email, $subject);
            
            return ['success' => true, 'message' => 'Message sent successfully. We will get back to you soon.'];
        }

        return ['success' => false, 'message' => 'Failed to send message'];
    }

    /**
     * Get contact message by ID
     */
    public function getMessageById($id) {
        $stmt = $this->db->prepare('SELECT * FROM contacts WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Get all messages (admin)
     */
    public function getAllMessages($status = null, $limit = null, $offset = 0) {
        if ($status) {
            if ($limit) {
                $stmt = $this->db->prepare('SELECT * FROM contacts WHERE status = ? ORDER BY created_at DESC LIMIT ? OFFSET ?');
                $stmt->bind_param('sii', $status, $limit, $offset);
            } else {
                $stmt = $this->db->prepare('SELECT * FROM contacts WHERE status = ? ORDER BY created_at DESC');
                $stmt->bind_param('s', $status);
            }
        } else {
            if ($limit) {
                $result = $this->db->query('SELECT * FROM contacts ORDER BY created_at DESC LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset);
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = $this->db->query('SELECT * FROM contacts ORDER BY created_at DESC');
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Update message status
     */
    public function updateStatus($id, $status) {
        $allowedStatuses = ['new', 'read', 'replied'];
        
        if (!in_array($status, $allowedStatuses)) {
            return ['success' => false, 'message' => 'Invalid status'];
        }

        $stmt = $this->db->prepare('UPDATE contacts SET status = ? WHERE id = ?');
        $stmt->bind_param('si', $status, $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Status updated successfully'];
        }

        return ['success' => false, 'message' => 'Failed to update status'];
    }

    /**
     * Delete message
     */
    public function deleteMessage($id) {
        $stmt = $this->db->prepare('DELETE FROM contacts WHERE id = ?');
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Message deleted successfully'];
        }

        return ['success' => false, 'message' => 'Failed to delete message'];
    }

    /**
     * Get message count by status
     */
    public function getMessageCount($status = null) {
        if ($status) {
            $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM contacts WHERE status = ?');
            $stmt->bind_param('s', $status);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc()['count'];
        }
        
        $result = $this->db->query('SELECT COUNT(*) as count FROM contacts');
        return $result->fetch_assoc()['count'];
    }

    /**
     * Send admin notification (placeholder)
     */
    private function sendAdminNotification($name, $email, $subject) {
        // TODO: Implement email sending to admin
        error_log("New contact form submission from: $name ($email) - Subject: $subject");
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'send_message') {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'CSRF token validation failed']);
            exit;
        }

        $contact = new Contact();
        $result = $contact->saveMessage($_POST);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
