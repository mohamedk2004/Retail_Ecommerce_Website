<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Products extends Model
{
  private $produc_id;
  private $category_id;
  private $product_name;
  private $product_description;
  private $product_price;
  private $stock_Quantity;
  private $createdAt;
  private $productImage;

  
  function __construct($id, $category_id, $product_name = "", $product_description = "", $product_price = "", $stock_Quantity = "", $productImage = "")
  {
    $this->produc_id = $id;
    $this->category_id = $category_id;
    $this->db = $this->connect();

    if ("" === $product_name) {
      $this->readUser($id);
    } else {
      $this->product_name = $product_name;
      $this->product_description = $product_description;
      $this->product_price = $product_price;
      $this->stock_Quantity = $phonestock_Quantity;
      $this->createdAt = Date();
      $this->productImage = $productImage;
    }
  }

  public function getProduc_id(){
    return $this->produc_id;
}


public function getCategory_id(){
    return $this->category_id;
}
 

public function getProduct_name(){
    return $this->product_name;
}

public function setProduct_name($product_name){
    $this->product_name = $productName;
}

public function getProduct_description(){
    return $this->product_description;
}

public function setProduct_description($product_description){
    $this->product_description = $product_description;
}

public function getProduct_price(){
    return $this->product_price;
}

public function setProduct_price($product_price){
    $this->product_price = $product_price;
}

public function getStock_Quantity(){
    return $this->stock_Quantity;
}

public function setStock_Quantity($stock_Quantity){
    $this->stock_Quantity = $stock_Quantity;
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
        $this->category_id = $row["category_id"];
        $this->product_name = $row["product_name"];
        $this->product_description = $row["product_description"];
        $this->product_price = $row["product_price"];
        $this->stock_Quantity = $row["stock_Quantity"];
        $this->createdAt = $row["createdAt"];
        $this->productImage = $row["productImage"];

        // Optionally, you could store this in a session if needed
        $_SESSION["product_name"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->produc_id = "";
        $this->category_id = "";
        $this->product_name = "";
        $this->product_description = "";
        $this->product_price = "";
        $this->stock_Quantity = "";
        $this->createdAt = "";
        $this->productImage = "";
    }
}

function editProduct($product_name, $product_description, $product_price, $stock_Quantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET product_name='$productName', product_description='$product_description', product_price='$product_price', stock_Quantity='$stock_Quantity' WHERE produc_id=$this->produc_id;";

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