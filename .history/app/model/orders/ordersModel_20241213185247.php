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
        $result = $this->readProducts(); // Get orders from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->orders, new Product(
                $row["product_id"],
                $row["category_id"],
                $row["product_name"],
                $row["product_description"],
                $row["product_price"],
                $row["stock_quantity"],
                $row["created_at"],
                $row["product_image"]
            ));
        }
    }

    function getProducts() {
        return $this->orders; // Return the orders array
    }

    function readProducts() {
        // SQL query to select all orders from the orders table
        $sql = "SELECT * FROM orders";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are orders
        } else {
            return false; // Return false if no orders are found
        }
    }

    function addProduct($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the orders table
        $sql = "INSERT INTO orders (product_name, product_description, product_price, stock_quantity, product_image) 
                VALUES ('$product_name', '$product_description', '$product_price', '$stock_quantity', '$product_image')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the orders array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}