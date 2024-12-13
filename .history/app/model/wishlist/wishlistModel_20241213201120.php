<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "wishlists.php");

class WishlistsModel extends Model {
	private $wishlists; 

    function __construct() {
        $this->fillArray(); // Populate the wishlists array on initialization
    }

    function fillArray() {
        $this->wishlists = array(); // Initialize the wishlists array
        $this->db = $this->connect(); // Database connection
        $result = $this->readWishlists(); // Get wishlists from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Wishlist class has a constructor matching the table columns
            array_push($this->wishlists, new Wishlist(
                $row["wishlist_id"],
                $row["category_id"],
                $row["wishlist_name"],
                $row["wishlist_description"],
                $row["wishlist_price"],
                $row["stock_quantity"],
                $row["created_at"],
                $row["wishlist_image"]
            ));
        }
    }

    function getWishlists() {
        return $this->wishlists; // Return the wishlists array
    }

    function readWishlists() {
        // SQL query to select all wishlists from the wishlists table
        $sql = "SELECT * FROM wishlists";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are wishlists
        } else {
            return false; // Return false if no wishlists are found
        }
    }

    function addWishlist($wishlistName, $wishlistDescription, $wishlistPrice, $stockQuantity, $wishlistImage) {
        // SQL query to insert a new wishlist into the wishlists table
        $sql = "INSERT INTO wishlists (wishlist_name, wishlist_description, wishlist_price, stock_quantity, wishlist_image) 
                VALUES ('$wishlist_name', '$wishlist_description', '$wishlist_price', '$stock_quantity', '$wishlist_image')";
        if ($this->db->query($sql) === true) {
            echo "Wishlist inserted successfully.";
            $this->fillArray(); // Refresh the wishlists array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}