<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class WishlistItem extends Model
{
  private $wishlist_item_id;
  private $wishlist_id;
  private $product_id;

  
  function __construct($id, $wishlist_id)
  {
    $this->wishlist_item_id = $id;
    $this->wishlist_id = $wishlist_id;
    $this->db = $this->connect();
    $this->readWishlist($id);
  }

  public function getWishlist_item_id(){
    return $this->wishlist_item_id;
}


public function getUser_id(){
    return $this->wishlist_id;
}
public function getProduct_id(){
    return $this->product_id;
}


function readWishlistItems($id)
{
    // Correct the SQL query to select from the wishlist table.
    $sql = "SELECT * FROM wishlist_items WHERE wishlist_item_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the wishlist_item data to the class properties
        $this->wishlist_item_id = $row["wishlist_item_id"];
        $this->wishlist_id = $row["wishlist_id"];
        $this->product_id = $row["product_id"];


        // Optionally, you could store this in a session if needed
        $_SESSION["wishlist_item_id"] = $row["wishlist_item_id"];
    }
}

function deleteWishlistitem()
{
    // Prepare the SQL query to delete the wishlist_item
    $sql = "DELETE FROM wishlist_items WHERE wishlist_item_id=$this->wishlist_item_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Wishlist item deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

}