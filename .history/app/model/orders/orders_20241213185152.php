<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Orders extends Model
{
  private $order_id;
  private $user_id;
  private $order_date;
  private $total_amount;
  private OrderStatus $orderStatus;
  
  
  function __construct($id, $user_id, $order_date = "", $total_amount = "", $orderStatus = "pending")
  {
    $this->productId = $id;
    $this->categoryId = $user_id;
    $this->db = $this->connect();

    if ("" === $order_date) {
      $this->readUser($id);
    } else {
      $this->order_date = $order_date;
      $this->total_amount = $total_amount;
      $this->orderStatus = $orderStatus;
    }
  }

  public function getOrderId(){
    return $this->order_;
}


public function getUser_id(){
    return $this->user_id;
}

public function getOrderDate(){
    return $this->order_date;
}

public function setOrderDate($order_date){
    $this->order_date = $order_date;
}

public function getTotalAmount(){
    return $this->total_amount;
}

public function setTotalAmount($total_amount){
    $this->total_amount = $total_amount;
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
        $this->user_id = $row["user_id"];
        $this->order_date = $row["order_date"];
        $this->total_amount = $row["total_amount"];
        $this->orderStatus = $row["status"];

        // Optionally, you could store this in a session if needed
        $_SESSION["orderStatus"] = $row["orderStatus"];
    } else {
        // Set attributes to empty values if no product is found
        $this->order_ = "";
        $this->user_id = "";
        $this->order_date = "";
        $this->total_amount = "";
        $this->orderStatus = "";
    }
}

function editOrder($orderStatus)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET status='$orderStatus' WHERE order_id=$this->order_;";

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