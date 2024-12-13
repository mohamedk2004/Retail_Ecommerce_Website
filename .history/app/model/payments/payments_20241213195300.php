<?php
  require_once(__ROOT__ . "model/model.php");
  include "enums.php";

?>

<?php
class Payment extends Model
{
  private $payment_id;
  private $order_id;
  private $amount;
  private PaymentMethod $payment_method;
  private $payment_date;


  
  function __construct($payment_id, $order_id, $amount = "", $payment_method = "cash", $payment_date = "")
  {
    $this->payment_id = $payment_id;
    $this->order_id = $order_id;
    $this->db = $this->connect();

    if ("" === $amount) {
      $this->readPayment($id);
    } else {
      $this->amount = $amount;
      $this->payment_method = $payment_method;
      $this->payment_date = $payment_date;
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
    return $this->amount;
}

public function setProduct_name($amount){
    $this->amount = $productName;
}

public function getProduct_description(){
    return $this->payment_method;
}

public function setProduct_description($payment_method){
    $this->payment_method = $payment_method;
}

public function getProduct_price(){
    return $this->payment_date;
}

public function setProduct_price($payment_date){
    $this->payment_date = $payment_date;
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
        $this->amount = $row["amount"];
        $this->payment_method = $row["payment_method"];
        $this->payment_date = $row["payment_date"];
        $this->stock_quantity = $row["stock_quantity"];
        $this->created_at = $row["created_at"];
        $this->product_image = $row["product_image"];

        // Optionally, you could store this in a session if needed
        $_SESSION["amount"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->amount = "";
        $this->payment_method = "";
        $this->payment_date = "";
        $this->stock_quantity = "";
        $this->created_at = "";
        $this->product_image = "";
    }
}

function editProduct($amount, $payment_method, $payment_date, $stock_quantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET amount='$productName', payment_method='$payment_method', payment_date='$payment_date', stock_quantity='$stock_quantity' WHERE payment_id=$this->payment_id;";

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