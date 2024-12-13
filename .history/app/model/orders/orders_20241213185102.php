<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Orders extends Model
{
  private $order_id;
  private $userId;
  private $orderDate;
  private $totalAmount;
  private OrderStatus $orderStatus;
  
  
  function __construct($id, $userId, $orderDate = "", $totalAmount = "", $orderStatus = "pending")
  {
    $this->productId = $id;
    $this->categoryId = $userId;
    $this->db = $this->connect();

    if ("" === $orderDate) {
      $this->readUser($id);
    } else {
      $this->orderDate = $orderDate;
      $this->totalAmount = $totalAmount;
      $this->orderStatus = $orderStatus;
    }
  }

  public function getOrderId(){
    return $this->order_;
}


public function getUserId(){
    return $this->userId;
}

public function getOrderDate(){
    return $this->orderDate;
}

public function setOrderDate($orderDate){
    $this->orderDate = $orderDate;
}

public function getTotalAmount(){
    return $this->totalAmount;
}

public function setTotalAmount($totalAmount){
    $this->totalAmount = $totalAmount;
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
        $this->userId = $row["userId"];
        $this->orderDate = $row["order_date"];
        $this->totalAmount = $row["total_amount"];
        $this->orderStatus = $row["status"];

        // Optionally, you could store this in a session if needed
        $_SESSION["orderStatus"] = $row["orderStatus"];
    } else {
        // Set attributes to empty values if no product is found
        $this->order_ = "";
        $this->userId = "";
        $this->orderDate = "";
        $this->totalAmount = "";
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