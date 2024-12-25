<?php
require_once('../../db/Dbh.php');
require_once('loginStrategy.php');


class CustomerLoginStrategy implements LoginStrategy {
    private $db;

    public function __construct(DBh $db) {
        $this->db = $db;
    }

    public function handleLogin(string $email, string $password): void {
        $conn = $this->db->getConn(); // Get the database connection
        $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect to home page
            header("Location: /home.php");
            exit;
        } else {
            // Handle failed customer login
            echo "Customer login failed. Please try again.";
        }
    }
}