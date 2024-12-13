<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Review extends Model
{
    private $review_id;
  private $product_id;
  private $user_id;
  private $rating;
  private $review;
  private $created_at;

  
  function __construct($review_id, $product_id, $user_id, $rating = "", $review = "")
  {
    $this->review_id = $review_id;
    $this->product_id = $product_id;
    $this->user_id = $user_id;
    $this->db = $this->connect();

    if ("" === $rating) {
      $this->readReview($id);
    } else {
      $this->rating = $rating;
      $this->review = $review;
      $this->created_at = Date();
    }
  }

  public function getProduct_id(){
    return $this->product_id;
}



public function getReview_id(){
    return $this->review_id;
}



public function getUser_id(){
    return $this->user_id;
}



public function getRating(){
    return $this->rating;
}

public function setRating($rating){
    $this->rating = $rating;
}

public function getReview(){
    return $this->review;
}

public function setReview($review){
    $this->review = $review;
}

public function getCreated_at(){
    return $this->created_at;
}

public function setCreated_at($created_at){
    $this->created_at = $created_at;
}

function readReview($id)
{
    // Correct the SQL query to select from the reviews table.
    $sql = "SELECT * FROM reviews WHERE review = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the review data to the class properties
        $this->review_id = $row["review_id"];
        $this->product_id = $row["product_id"];
        $this->user_id = $row["user_id"];
        $this->rating = $row["rating"];
        $this->review = $row["review"];
        $this->created_at = $row["created_at"];

        // Optionally, you could store this in a session if needed
        $_SESSION["rating"] = $row["rating"];
    } else {
        // Set attributes to empty values if no product is found
        $this->rating = "";
        $this->review = "";
        $this->created_at = "";
    }
}

function editReview($rating, $review)
{
    // Prepare the SQL query to update review details
    $sql = "UPDATE review SET rating='$rating', review='$review' WHERE review_id=$this->review_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->product_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE product_id=$this->product_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}