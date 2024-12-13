<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "orderitems.php");

class OrdertItemsModel extends Model {
	private $orderItems; 

    function __construct() {
        $this->fillArray(); // Populate the orderItems array on initialization
    }

    function fillArray() {
        $this->orderItems = array(); // Initialize the orderItems array
        $this->db = $this->connect(); // Database connection
        $result = $this->readProducts(); // Get orderItems from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->orderItems, new Product(
                $row["order_i"],
                $row["user_id"],
                $row["order_date"],
                $row["total_amount"],
                $row["order_status"],
            ));
        }
    }

    function getProducts() {
        return $this->orderItems; // Return the orderItems array
    }

    function readProducts() {
        // SQL query to select all orderItems from the orderItems table
        $sql = "SELECT * FROM orderItems";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are orderItems
        } else {
            return false; // Return false if no orderItems are found
        }
    }

    function addProduct($user_id, $order_date, $total_amount, $order_status) {
        // SQL query to insert a new product into the orderItems table
        $sql = "INSERT INTO orderItems (user_id, order_date, total_amount, order_status) 
                VALUES ('$user_id',$order_date', '$total_amount', '$order_status')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the orderItems array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}