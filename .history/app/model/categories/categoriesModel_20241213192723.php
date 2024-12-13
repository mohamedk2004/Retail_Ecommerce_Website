<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "category.php");

class CategoryModel extends Model {
	private $categorie; 

    function __construct() {
        $this->fillArray(); // Populate the categor array on initialization
    }

    function fillArray() {
        $this->categor = array(); // Initialize the categor array
        $this->db = $this->connect(); // Database connection
        $result = $this->readProducts(); // Get categor from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->categor, new Product(
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
        return $this->categor; // Return the categor array
    }

    function readProducts() {
        // SQL query to select all categor from the categor table
        $sql = "SELECT * FROM categor";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are categor
        } else {
            return false; // Return false if no categor are found
        }
    }

    function addProduct($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the categor table
        $sql = "INSERT INTO categor (product_name, product_description, product_price, stock_quantity, product_image) 
                VALUES ('$product_name', '$product_description', '$product_price', '$stock_quantity', '$product_image')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the categor array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}