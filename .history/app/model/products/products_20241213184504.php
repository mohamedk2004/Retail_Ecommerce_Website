<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Products extends Model
{
  private $produc_id;
  private $categoryId;
  private $productName;
  private $productDescription;
  private $productPrice;
  private $stockQuantity;
  private $createdAt;
  private $productImage;

  
  function __construct($id, $categoryId, $productName = "", $productDescription = "", $productPrice = "", $stockQuantity = "", $productImage = "")
  {
    $this->produc_id = $id;
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

  public function getProduc_id(){
    return $this->produc_id;
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


function readProduct($id)
{
    // Correct the SQL query to select from the products table.
    $sql = "SELECT * FROM products WHERE produc_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->produc_id = $row["produc_id"];
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
        $this->produc_id = "";
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
    $sql = "UPDATE products SET productName='$productName', productDescription='$productDescription', productPrice='$productPrice', stockQuantity='$stockQuantity' WHERE produc_id=$this->produc_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->produc_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE produc_id=$this->produc_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}