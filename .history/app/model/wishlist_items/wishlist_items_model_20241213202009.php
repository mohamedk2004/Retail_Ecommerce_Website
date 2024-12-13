<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "wishlist_items.php");

class WishlistItemsModel extends Model {
	private $wishlistItems; 

    function __construct() {
        $this->fillArray(); // Populate the wishlistItems array on initialization
    }

    function fillArray() {
        $this->wishlistItems = array(); // Initialize the wishlistItems array
        $this->db = $this->connect(); // Database connection
        $result = $this->readWishlistItems(); // Get wishlistItems from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Wishlist class has a constructor matching the table columns
            array_push($this->wishlistItems, new WishlistItem(
                $row["wishlist_item_id"],
                $row["wishlist_id"],
                $row["product_id"],
            ));
        }
    }

    function getWishlistItems() {
        return $this->wishlistItems; // Return the wishlistItems array
    }

    function readWishlistItems() {
        // SQL query to select all wishlistItems from the wishlistItems table
        $sql = "SELECT * FROM wishlist_items";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are wishlistItems
        } else {
            return false; // Return false if no wishlistItems are found
        }
    }


    function addWishlistItem($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the products table
        $sql = "INSERT INTO products (product_name, product_description, product_price, stock_quantity, product_image) 
                VALUES ('$product_name', '$product_description', '$product_price', '$stock_quantity', '$productImage')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the products array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}