<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class OrderItems extends Model
{
  private $order_id;
  private $order_item_id;
  private $product_id;
  private $quantity;
  private $price;
  
  
  function __construct($order_id, $order_item_id, $quantity = "", $price = "")
  {
    $this->order_id = $order_id;
    $this->categoryIdo = $order_item_id;
    $this->db = $this->connect();

    if ("" === $qunatity) {
      $this->readUser($id);
    } else {
      $this->product_id = $product_id;
      $this->quantity = $quantity;
      $this->price = $price;
    }
  }

  public function getOrderId(){
    return $this->order_;
}


public function getOrder_item_id(){
    return $this->order_item_id;
}

public function getOrderDate(){
    return $this->product_id;
}

public function setOrderDate($product_id){
    $this->product_id = $product_id;
}

public function getTotalAmount(){
    return $this->quantity;
}

public function setTotalAmount($quantity){
    $this->quantity = $quantity;
}

function readOrder($id)
{
    // Correct the SQL query to select from the products table.
    $sql = "SELECT * FROM orders WHERE order_ = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->order_ = $row["order_"];
        $this->order_item_id = $row["order_item_id"];
        $this->product_id = $row["product_id"];
        $this->quantity = $row["quantity"];
        $this->price = $row["status"];

        // Optionally, you could store this in a session if needed
        $_SESSION["price"] = $row["price"];
    } else {
        // Set attributes to empty values if no product is found
        $this->order_ = "";
        $this->order_item_id = "";
        $this->product_id = "";
        $this->quantity = "";
        $this->price = "";
    }
}

function editOrder($price)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET status='$price' WHERE order_id=$this->order_;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->productId);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE productId=$this->productId;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}