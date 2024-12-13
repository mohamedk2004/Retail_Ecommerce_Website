<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Review extends Model
{
  private $product_id;
  private $review_id;
  private $user_id;
  private $rating;
  private $review;
  private $created_at;

  
  function __construct($review_id, $product_id, $user_id = "", $rating = "", $review = "", $stock_quantity = "", $product_image = "")
  {
    $this->review_id = $review_id;
    $this->db = $this->connect();

    if ("" === $user_id) {
      $this->readUser($id);
    } else {
      $this->user_id = $user_id;
      $this->rating = $rating;
      $this->review = $review;
      $this->stock_quantity = $stock_quantity;
      $this->created_at = Date();
      $this->product_image = $product_image;
    }
  }

  public function getProduct_id(){
    return $this->product_id;
}


public function getCategory_id(){
    return $this->review_id;
}
 

public function getProduct_name(){
    return $this->user_id;
}

public function setProduct_name($user_id){
    $this->user_id = $productName;
}

public function getProduct_description(){
    return $this->rating;
}

public function setProduct_description($rating){
    $this->rating = $rating;
}

public function getProduct_price(){
    return $this->review;
}

public function setProduct_price($review){
    $this->review = $review;
}

public function getStock_quantity(){
    return $this->stock_quantity;
}

public function setStock_quantity($stock_quantity){
    $this->stock_quantity = $stock_quantity;
}

public function getCreated_at(){
    return $this->created_at;
}


public function getProduct_image(){
    return $this->product_image;
}

public function setProduct_image($product_image){
    $this->product_image = $product_image;
}


function readProduct($id)
{
    // Correct the SQL query to select from the products table.
    $sql = "SELECT * FROM products WHERE product_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->product_id = $row["product_id"];
        $this->review_id = $row["review_id"];
        $this->user_id = $row["user_id"];
        $this->rating = $row["rating"];
        $this->review = $row["review"];
        $this->stock_quantity = $row["stock_quantity"];
        $this->created_at = $row["created_at"];
        $this->product_image = $row["product_image"];

        // Optionally, you could store this in a session if needed
        $_SESSION["user_id"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->user_id = "";
        $this->rating = "";
        $this->review = "";
        $this->stock_quantity = "";
        $this->created_at = "";
        $this->product_image = "";
    }
}

function editProduct($user_id, $rating, $review, $stock_quantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET user_id='$productName', rating='$rating', review='$review', stock_quantity='$stock_quantity' WHERE product_id=$this->product_id;";

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