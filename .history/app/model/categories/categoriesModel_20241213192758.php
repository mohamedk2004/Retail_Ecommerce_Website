<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "category.php");

class CategoryModel extends Model {
	private $categories; 

    function __construct() {
        $this->fillArray(); // Populate the categories array on initialization
    }

    function fillArray() {
        $this->categories = array(); // Initialize the categories array
        $this->db = $this->connect(); // Database connection
        $result = $this->readProducts(); // Get categories from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->categories, new Product(
                $row["category_id"],
                $row["category_name"],
                $row["product_description"],
                $row["product_price"],
                $row["stock_quantity"],
                $row["created_at"],
                $row["product_image"]
            ));
        }
    }

    function getProducts() {
        return $this->categories; // Return the categories array
    }

    function readProducts() {
        // SQL query to select all categories from the categories table
        $sql = "SELECT * FROM categories";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are categories
        } else {
            return false; // Return false if no categories are found
        }
    }

    function addProduct($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the categories table
        $sql = "INSERT INTO categories (category_name, product_description, product_price, stock_quantity, product_image) 
                VALUES ('$category_name', '$product_description', '$product_price', '$stock_quantity', '$product_image')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the categories array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}