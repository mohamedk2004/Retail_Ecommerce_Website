<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Orders extends Model
{
  private $orderId;
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
    return $this->orderId;
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
    $sql = "SELECT * FROM products WHERE orderId = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->productId = $row["productId"];
        $this->categoryId = $row["categoryId"];
        $this->productName = $row["productName"];
        $this->productDescription = $row["productDescription"];
        $this->productPrice = $row["productPrice"];
        $this->stockQuantity = $row["stockQuantity"];
        $this->createdAt = $row["createdAt"];
        $this->productImage = $row["productImage"];

        // Optionally, you could store this in a session if needed
        $_SESSION["productName"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->productId = "";
        $this->categoryId = "";
        $this->productName = "";
        $this->productDescription = "";
        $this->productPrice = "";
        $this->stockQuantity = "";
        $this->createdAt = "";
        $this->productImage = "";
    }
}

function editProduct($productName, $productDescription, $productPrice, $stockQuantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET productName='$productName', productDescription='$productDescription', productPrice='$productPrice', stockQuantity='$stockQuantity' WHERE productId=$this->productId;";

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