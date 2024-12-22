<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Wishlist extends Model
{
  private $wishlist_id;
  private $category_id;
  private $product_name;
  private $product_description;
  private $product_price;
  private $stock_quantity;
  private $created_at;
  private $product_image;

  
  function __construct($id, $category_id, $product_name = "", $product_description = "", $product_price = "", $stock_quantity = "", $product_image = "")
  {
    $this->wishlist_id = $id;
    $this->category_id = $category_id;
    $this->db = $this->connect();

    if ("" === $product_name) {
      $this->readUser($id);
    } else {
      $this->product_name = $product_name;
      $this->product_description = $product_description;
      $this->product_price = $product_price;
      $this->stock_quantity = $stock_quantity;
      $this->created_at = Date();
      $this->product_image = $product_image;
    }
  }

  public function getProduct_id(){
    return $this->wishlist_id;
}


public function getCategory_id(){
    return $this->category_id;
}
 

public function getProduct_name(){
    return $this->product_name;
}

public function setProduct_name($product_name){
    $this->product_name = $productName;
}

public function getProduct_description(){
    return $this->product_description;
}

public function setProduct_description($product_description){
    $this->product_description = $product_description;
}

public function getProduct_price(){
    return $this->product_price;
}

public function setProduct_price($product_price){
    $this->product_price = $product_price;
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
    $sql = "SELECT * FROM products WHERE wishlist_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->wishlist_id = $row["wishlist_id"];
        $this->category_id = $row["category_id"];
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
    $sql = "UPDATE products SET product_name='$productName', product_description='$product_description', product_price='$product_price', stock_quantity='$stock_quantity' WHERE wishlist_id=$this->wishlist_id;";

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
    $sql = "DELETE FROM products WHERE wishlist_id=$this->wishlist_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}