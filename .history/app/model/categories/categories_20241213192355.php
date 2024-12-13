<?php
  require_once(__ROOT__ . "model/model.php");
?>

<?php
class Category extends Model
{
  private $category_id;
  private $category_name;
  private $category_description;


  
  function __construct($category_id, $category_name = "", $category_description = "")
  {
    $this->category_id = $category_id;
    $this->db = $this->connect();

    if ("" === $category_name) {
      $this->readCategory($id);
    } else {
      $this->category_name = $category_name;
      $this->category_description = $category_description;
    }
  }

  public function getCategory_id(){
	return $this->category_id;
}


public function getCategory_name(){
	return $this->category_name;
}

public function setCategory_name($category_name){
	$this->category_name = $category_name;
}

public function getCategory_description(){
	return $this->category_description;
}

public function setCategory_description($category_description){
	$this->category_description = $category_description;
}



function readCategory($id)
{
    // Correct the SQL query to select from the categories table.
    $sql = "SELECT * FROM categories WHERE category_id = " . $id;
    $db = $this->connect();
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Assign the product data to the class properties
        $this->category_id = $row["category_id"];
        $this->category_name = $row["category_name"];
        $this->category_description = $row["category_description"]

        // Optionally, you could store this in a session if needed
        $_SESSION["category_name"] = $row["productName"];
    } else {
        // Set attributes to empty values if no product is found
        $this->category_name = "";
        $this->category_description = "";
        $this->product_price = "";
        $this->stock_quantity = "";
        $this->created_at = "";
        $this->product_image = "";
    }
}

function editProduct($category_name, $category_description, $product_price, $stock_quantity)
{
    // Prepare the SQL query to update product details
    $sql = "UPDATE products SET category_name='$productName', category_description='$category_description', product_price='$product_price', stock_quantity='$stock_quantity' WHERE category_id=$this->category_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product updated successfully.";
        // Optionally, re-read the product data after updating
        $this->readProduct($this->category_id);
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}

function deleteProduct()
{
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM products WHERE category_id=$this->category_id;";

    // Execute the query and check if it's successful
    if ($this->db->query($sql) === true) {
        echo "Product deleted successfully.";
    } else {
        echo "ERROR: Could not execute $sql. " . $this->db->error;
    }
}
}