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
  
  
  function __construct($order_id, $order_item_id, $product_id, $quantity = "", $price = "")
  {
    $this->order_id = $order_id;
    $this->order_item_id = $order_item_id;
    $this->product_id = $product_id;
    $this->db = $this->connect();

    if ("" === $qunatity) {
      $this->readOrderItem($id);
    } else {
      $this->quantity = $quantity;
      $this->price = $price;
    }
  }

 
  public function getOrder_id(){
    return $this->order_id;
}


public function getOrder_item_id(){
    return $this->order_item_id;
}



public function getProduct_id(){
    return $this->product_id;
}


public function getQuantity(){
    return $this->quantity;
}

public function setQuantity($quantity){
    $this->quantity = $quantity;
}

public function getPrice(){
    return $this->price;
}

public function setPrice($price){
    $this->price = $price;
}


function readOrderItem($order_item_id)
{
    // Correct the SQL query to select from the order_items table.
    $sql = "SELECT * FROM order_items WHERE order_item_id= " . $order_item_id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the order_item data to the class properties
        $this->order_id = $row["order_id"];
        $this->order_item_id = $row["order_item_id"];
        $this->product_id = $row["product_id"];
        $this->quantity = $row["quantity"];
        $this->price = $row["price"];

        // Optionally, you could store this in a session if needed
        $_SESSION["quantity"] = $row["quantity"];
    } else {
        // Set attributes to empty values if no order_item is found
        $this->quantity = "";
        $this->price = "";
    }
}

function editOrderItem($quantity)
{
    // Prepare the SQL query to update order_item quantity
    $sql = "UPDATE order_items SET quantity='$quantity' WHERE order_item_id=$this->order_item_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Order item updated successfully.";
        // Optionally, re-read the order_item data after updating
        $this->readOrderItem($this->order_item_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteOrderItem()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE order_item_id=$this->order_item_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}