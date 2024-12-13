<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "reviews.php");

class ReviewsModel extends Model {
	private $reviews; 

    function __construct() {
        $this->fillArray(); // Populate the reviews array on initialization
    }

    function fillArray() {
        $this->reviews = array(); // Initialize the reviews array
        $this->db = $this->connect(); // Database connection
        $result = $this->readReviews(); // Get reviews from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming reviews class has a constructor matching the table columns
            array_push($this->reviews, new Review(
                $row["review_id"],
                $row["product_id"],
                $row["user_id"],
                $row["rating"],
                $row["review"],
                $row["created_at"],
            ));
        }
    }

    function getReviews() {
        return $this->reviews; // Return the reviews array
    }

    function readReviews() {
        // SQL query to select all reviews from the reviews table
        $sql = "SELECT * FROM reviews";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are reviews
        } else {
            return false; // Return false if no reviews are found
        }
    }

    function addReview($product_id, $user_id, $rating, $review) {
        // SQL query to insert a new review into the reviews table
        $sql = "INSERT INTO reviews (product_id, user_id, rating, review, product_image) 
                VALUES ('$product_name', '$product_description', '$product_price', '$stock_quantity', '$product_image')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the reviews array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}