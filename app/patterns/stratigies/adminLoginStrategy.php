<?php

require_once('../../db/Dbh.php');
require_once('loginStrategy.php');


class AdminLoginStrategy implements LoginStrategy {
    private $db;

    public function __construct(DBh $db) {
        $this->db = $db;
    }

    
    public function handleLogin(string $email, string $password): void {
        // Check if the email starts with 'admin'
        if (!str_starts_with($email, 'admin')) {
            echo "Invalid admin email.";
            return;
        }
        $conn = $this->db->getConn(); // Get the database connection
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect to admin dashboard
            header("Location: /adminDashboard.php");
            exit;
        } else {
            // Handle failed admin login
            echo "Admin login failed. Please try again.";
        }
    }
}