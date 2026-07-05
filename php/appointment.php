<?php
/**
 * Appointment Management
 * Handles booking, updating, and deleting appointments
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

class Appointment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Book an appointment
     */
    public function bookAppointment($data) {
        // Validation
        if (empty($data['service_id']) || empty($data['barber_id']) || empty($data['appointment_date']) || 
            empty($data['appointment_time']) || empty($data['customer_name']) || empty($data['customer_email']) || 
            empty($data['customer_phone'])) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        // Validate email
        if (!isValidEmail($data['customer_email'])) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        // Validate phone
        if (!isValidPhone($data['customer_phone'])) {
            return ['success' => false, 'message' => 'Invalid phone number'];
        }

        // Validate date (must be future date)
        $appointmentDate = new DateTime($data['appointment_date']);
        $today = new DateTime();
        if ($appointmentDate < $today) {
            return ['success' => false, 'message' => 'Appointment date must be in the future'];
        }

        // Validate service and barber exist
        $service = getServiceById($data['service_id']);
        $barber = getBarberById($data['barber_id']);
        
        if (!$service || !$barber) {
            return ['success' => false, 'message' => 'Invalid service or barber selection'];
        }

        // Check for duplicate booking
        $stmt = $this->db->prepare('SELECT id FROM appointments WHERE barber_id = ? AND appointment_date = ? AND appointment_time = ? AND status != "cancelled"');
        $stmt->bind_param('iss', $data['barber_id'], $data['appointment_date'], $data['appointment_time']);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            return ['success' => false, 'message' => 'This time slot is already booked'];
        }

        // Sanitize input
        $customerName = sanitize($data['customer_name']);
        $customerEmail = sanitize($data['customer_email']);
        $customerPhone = sanitize($data['customer_phone']);
        $notes = isset($data['notes']) ? sanitize($data['notes']) : '';
        $userId = isUserLoggedIn() ? $_SESSION['user_id'] : null;

        // Insert appointment
        $stmt = $this->db->prepare('INSERT INTO appointments (user_id, service_id, barber_id, customer_name, customer_email, customer_phone, appointment_date, appointment_time, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "pending")');
        $stmt->bind_param('iiisssss', $userId, $data['service_id'], $data['barber_id'], $customerName, $customerEmail, $customerPhone, $data['appointment_date'], $data['appointment_time'], $notes);

        if ($stmt->execute()) {
            $appointmentId = $this->db->insert_id;
            
            // Send confirmation email (you can implement email sending)
            $this->sendConfirmationEmail($customerEmail, $customerName, $service['name'], $data['appointment_date'], $data['appointment_time']);
            
            return ['success' => true, 'message' => 'Appointment booked successfully', 'appointment_id' => $appointmentId];
        }

        return ['success' => false, 'message' => 'Failed to book appointment'];
    }

    /**
     * Get appointment by ID
     */
    public function getAppointmentById($id) {
        $stmt = $this->db->prepare('SELECT a.*, s.name as service_name, b.first_name, b.last_name FROM appointments a JOIN services s ON a.service_id = s.id JOIN barbers b ON a.barber_id = b.id WHERE a.id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Get all appointments for user
     */
    public function getUserAppointments($userId) {
        $stmt = $this->db->prepare('SELECT a.*, s.name as service_name, b.first_name, b.last_name FROM appointments a JOIN services s ON a.service_id = s.id JOIN barbers b ON a.barber_id = b.id WHERE a.user_id = ? ORDER BY a.appointment_date DESC');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all appointments (admin)
     */
    public function getAllAppointments($limit = null, $offset = 0) {
        if ($limit) {
            $stmt = $this->db->prepare('SELECT a.*, s.name as service_name, b.first_name, b.last_name FROM appointments a JOIN services s ON a.service_id = s.id JOIN barbers b ON a.barber_id = b.id ORDER BY a.appointment_date DESC LIMIT ? OFFSET ?');
            $stmt->bind_param('ii', $limit, $offset);
        } else {
            $result = $this->db->query('SELECT a.*, s.name as service_name, b.first_name, b.last_name FROM appointments a JOIN services s ON a.service_id = s.id JOIN barbers b ON a.barber_id = b.id ORDER BY a.appointment_date DESC');
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Update appointment status
     */
    public function updateStatus($id, $status) {
        $allowedStatuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        
        if (!in_array($status, $allowedStatuses)) {
            return ['success' => false, 'message' => 'Invalid status'];
        }

        $stmt = $this->db->prepare('UPDATE appointments SET status = ? WHERE id = ?');
        $stmt->bind_param('si', $status, $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Status updated successfully'];
        }

        return ['success' => false, 'message' => 'Failed to update status'];
    }

    /**
     * Cancel appointment
     */
    public function cancelAppointment($id) {
        $stmt = $this->db->prepare('UPDATE appointments SET status = "cancelled" WHERE id = ?');
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Appointment cancelled successfully'];
        }

        return ['success' => false, 'message' => 'Failed to cancel appointment'];
    }

    /**
     * Delete appointment
     */
    public function deleteAppointment($id) {
        $stmt = $this->db->prepare('DELETE FROM appointments WHERE id = ?');
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Appointment deleted successfully'];
        }

        return ['success' => false, 'message' => 'Failed to delete appointment'];
    }

    /**
     * Send confirmation email (placeholder)
     */
    private function sendConfirmationEmail($email, $name, $service, $date, $time) {
        // TODO: Implement email sending using PHPMailer or similar
        // For now, this is a placeholder
        error_log("Appointment confirmation email to: $email for $name - $service on $date at $time");
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $appointment = new Appointment();
    
    if ($_POST['action'] === 'book') {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'CSRF token validation failed']);
            exit;
        }

        $result = $appointment->bookAppointment($_POST);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
