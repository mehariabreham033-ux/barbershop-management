<?php
/**
 * Database Connection Class
 * Handles all database operations
 */

require_once __DIR__ . '/../includes/config.php';

class Database {
    private $conn;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;

    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
            
            if ($this->conn->connect_error) {
                throw new Exception('Database Connection Failed: ' . $this->conn->connect_error);
            }
            
            $this->conn->set_charset('utf8mb4');
            return $this->conn;
        } catch (Exception $e) {
            error_log('Database Error: ' . $e->getMessage());
            die('Database connection error. Please try again later.');
        }
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $db = new self();
            $instance = $db->connect();
        }
        return $instance;
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }
}

// Initialize database connection
$db = Database::getInstance();
