<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Products extends Model
{
  private $product_id;
  private $category_id;
  private $product_name;
  private $product_description;
  private $product_price;
  private $stock_quantity;
  private $created_at;
  private $product_image;

  
  function __construct($id, $categoryId, $productName = "", $productDescription = "", $productPrice = "", $stockQuantity = "", $product_image = "")
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
      $this->s = Date();
      $this->product_image = $product_image;
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

public function getS(){
    return $this->s;
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
    $sql = "SELECT * FROM products WHERE productId = " . $id;
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
        $this->s = $row["s"];
        $this->product_image = $row["product_image"];

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
        $this->s = "";
        $this->product_image = "";
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