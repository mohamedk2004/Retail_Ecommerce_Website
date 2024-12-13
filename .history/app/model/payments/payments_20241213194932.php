<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Payment extends Model
{
  private $payment_id;
  private $order_id;
  private $product_name;
  private $product_description;
  private $product_price;
  private $stock_quantity;
  private $created_at;
  private $product_image;

  
  function __construct($id, $order_id, $product_name = "", $product_description = "", $product_price = "", $stock_quantity = "", $product_image = "")
  {
    $this->payment_id = $id;
    $this->order_id = $order_id;
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

  public function getPayment_id(){
    return $this->payment_id;
}


public function getOrder_id(){
    return $this->order_id;
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
    $sql = "SELECT * FROM products WHERE payment_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->payment_id = $row["payment_id"];
        $this->order_id = $row["order_id"];
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
    $sql = "UPDATE products SET product_name='$productName', product_description='$product_description', product_price='$product_price', stock_quantity='$stock_quantity' WHERE payment_id=$this->payment_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->payment_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE payment_id=$this->payment_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}