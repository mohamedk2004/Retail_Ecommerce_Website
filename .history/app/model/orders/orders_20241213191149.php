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
  private OrderStatus $order_status;
  
  
  function __construct($id, $user_id, $order_date = "", $total_amount = "", $order_status = "pending")
  {
    $this->productId = $id;
    $this->categoryId = $user_id;
    $this->db = $this->connect();

    if ("" === $order_date) {
      $this->readUser($id);
    } else {
      $this->order_date = $order_date;
      $this->total_amount = $total_amount;
      $this->order_status = $order_status;
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

        // Assign the order data to the class properties
        $this->order_ = $row["order_"];
        $this->user_id = $row["user_id"];
        $this->order_date = $row["order_date"];
        $this->total_amount = $row["total_amount"];
        $this->order_status = $row["status"];

        // Optionally, you could store this in a session if needed
        $_SESSION["order_status"] = $row["order_status"];
    } else {
        // Set attributes to empty values if no product is found
        $this->order_date = "";
        $this->total_amount = "";
        $this->order_status = "";
    }
}

function editOrder($order_status)
{
    // Prepare the SQL query to update order details
    $sql = "UPDATE orders SET status='$order_status' WHERE order_id=$this->order_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Order updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readOrder($this->order_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteOrder()
{
    // Prepare the SQL query to delete the order
    $sql = "DELETE FROM orders WHERE order_id=$this->order_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Order deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}