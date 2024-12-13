<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "orders.php");

class OrdersModel extends Model {
	private $orders; 

    function __construct() {
        $this->fillArray(); // Populate the orders array on initialization
    }

    function fillArray() {
        $this->orders = array(); // Initialize the orders array
        $this->db = $this->connect(); // Database connection
        $result = $this->readOrders(); // Get orders from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->orders, new Product(
                $row["order_id"],
                $row["user_id"],
                $row["order_date"],
                $row["total_amount"],
                $row["order_status"],
            ));
        }
    }

    function getOrders() {
        return $this->orders; // Return the orders array
    }

    function readOrders() {
        // SQL query to select all orders from the orders table
        $sql = "SELECT * FROM orders";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are orders
        } else {
            return false; // Return false if no orders are found
        }
    }

    function addProduct($user_id, $order_date, $total_amount, $order_status) {
        // SQL query to insert a new product into the orders table
        $sql = "INSERT INTO orders (user_id, order_date, total_amount, order_status) 
                VALUES ('$user_id',$order_date', '$total_amount', '$order_status')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the orders array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}