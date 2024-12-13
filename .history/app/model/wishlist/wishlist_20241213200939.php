<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Wishlist extends Model
{
  private $wishlist_id;
  private $user_id;

  
  function __construct($id, $user_id)
  {
    $this->wishlist_id = $id;
    $this->user_id = $user_id;
    $this->db = $this->connect();
    $this->readWishlist($id);
  }

  public function getWishlist-id(){
    return $this->wishlist_id;
}


public function getUser_id(){
    return $this->user_id;
}


function readWishlist($id)
{
    // Correct the SQL query to select from the wishlist table.
    $sql = "SELECT * FROM wishlist WHERE wishlist_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->wishlist_id = $row["wishlist_id"];
        $this->user_id = $row["user_id"];
        $this->product_name = $row["product_name"];
        $this->product_description = $row["product_description"];
        $this->product_price = $row["product_price"];
        $this->stock_quantity = $row["stock_quantity"];
        $this->created_at = $row["created_at"];
        $this->product_image = $row["product_image"];

        // Optionally, you could store this in a session if needed
        $_SESSION["product_name"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->product_name = "";
        $this->product_description = "";
        $this->product_price = "";
        $this->stock_quantity = "";
        $this->created_at = "";
        $this->product_image = "";
    }
}

function editProduct($product_name, $product_description, $product_price, $stock_quantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE wishlist SET product_name='$productName', product_description='$product_description', product_price='$product_price', stock_quantity='$stock_quantity' WHERE wishlist_id=$this->wishlist_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->wishlist_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM wishlist WHERE wishlist_id=$this->wishlist_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}