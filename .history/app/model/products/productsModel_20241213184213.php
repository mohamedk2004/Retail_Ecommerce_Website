<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "products.php");

class ProductsModel extends Model {
	private $products; 

    function __construct() {
        $this->fillArray(); // Populate the products array on initialization
    }

    function fillArray() {
        $this->products = array(); // Initialize the products array
        $this->db = $this->connect(); // Database connection
        $result = $this->readProducts(); // Get products from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->products, new Product(
                $row["product_id"],
                $row["category_id"],
                $row["product_name"],
                $row["product_)escription"],
                $row["productPrice"],
                $row["stockQuantity"],
                $row["createdAt"],
                $row["productImage"]
            ));
        }
    }

    function getProducts() {
        return $this->products; // Return the products array
    }

    function readProducts() {
        // SQL query to select all products from the products table
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are products
        } else {
            return false; // Return false if no products are found
        }
    }

    function addProduct($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the products table
        $sql = "INSERT INTO products (product_name, product_description, product_price, stock_quantity, product_image) 
                VALUES ('$productName', '$productDescription', '$productPrice', '$stockQuantity', '$productImage')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the products array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}