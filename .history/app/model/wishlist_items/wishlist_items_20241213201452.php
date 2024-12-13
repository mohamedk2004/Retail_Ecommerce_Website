<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class WishlistItems extends Model
{
  private $wishlist_item_id;
  private $user_id;

  
  function __construct($id, $user_id)
  {
    $this->wishlist_item_id = $id;
    $this->user_id = $user_id;
    $this->db = $this->connect();
    $this->readWishlist($id);
  }

  public function getWishlist_item_id(){
    return $this->wishlist_item_id;
}


public function getUser_id(){
    return $this->user_id;
}


function readWishlist($id)
{
    // Correct the SQL query to select from the wishlist table.
    $sql = "SELECT * FROM wishlist WHERE wishlist_item_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->wishlist_item_id = $row["wishlist_item_id"];
        $this->user_id = $row["user_id"];


        // Optionally, you could store this in a session if needed
        $_SESSION["wishlist_item_id"] = $row["wishlist_item_id"];
    }
}

}