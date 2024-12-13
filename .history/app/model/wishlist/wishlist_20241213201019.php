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


        // Optionally, you could store this in a session if needed
        $_SESSION["wishlist_id"] = $row["wishlist_id"];
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