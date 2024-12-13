<?php
  require_once(__ROOT__ . "model/Model.php");
?>

<?php
class Products extends Model
{
  private $productId;
  private $categoryId;
  private $productName;
  private $productDescription;
  private $productPrice;
  private $stockQuantity;
  private $createdAt;
  private $productImage;

  
  function __construct($id, $categoryId, $productName = "", $productDescription = "", $productPrice = "", $stockQuantity = "", $productImage = "")
  {
    $this->productId = $id;
    $this->categoryId = $categoryId;
    $this->db = $this->connect();

    if ("" === $productName) {
      $this->readUser($id);
    } else {
      $this->productName = $productName;
      $this->productDescription = $productDescription;
      $this->productPrice = $productPrice;
      $this->stockQuantity = $phonestockQuantity;
      $this->createdAt = Date();
      $this->productImage = $productImage;
    }
  }

  public function getProductId(){
    return $this->productId;
}


public function getCategoryId(){
    return $this->categoryId;
}
 

public function getProductName(){
    return $this->productName;
}

public function setProductName($productName){
    $this->productName = $productName;
}

public function getProductDescription(){
    return $this->productDescription;
}

public function setProductDescription($productDescription){
    $this->productDescription = $productDescription;
}

public function getProductPrice(){
    return $this->productPrice;
}

public function setProductPrice($productPrice){
    $this->productPrice = $productPrice;
}

public function getStockQuantity(){
    return $this->stockQuantity;
}

public function setStockQuantity($stockQuantity){
    $this->stockQuantity = $stockQuantity;
}

public function getCreatedAt(){
    return $this->createdAt;
}


public function getProductImage(){
    return $this->productImage;
}

public function setProductImage($productImage){
    $this->productImage = $productImage;
}


function readUser($id)
  {
    $sql = "SELECT * FROM user where ID=" . $id;
    $db = $this->connect();
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
      $row = $db->fetchRow();
      $this->name = $row["Name"];
      $_SESSION["Name"] = $row["Name"];
      $this->password = $row["Password"];
      $this->age = $row["Age"];
      $this->phone = $row["Phone"];
    } else {
      $this->name = "";
      $this->password = "";
      $this->age = "";
      $this->phone = "";
    }
    function editUser($name, $password, $age, $phone)
    {
      $sql = "update user set name='$name',password='$password', age='$age', phone='$phone' where id=$this->id;";
      if ($this->db->query($sql) === true) {
        echo "updated successfully.";
        $this->readUser($this->id);
      } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
      }

    }

    function deleteUser()
    {
      $sql = "delete from user where id=$this->id;";
      if ($this->db->query($sql) === true) {
        echo "deletet successfully.";
      } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
      }
    }

  }
}