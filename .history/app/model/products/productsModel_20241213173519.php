<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/User.php");

class ProductsModel extends Model {
	private $users;
	function __construct() {
		$this->fillArray();
	}

	function fillArray() {
		$this->users = array();
		$this->db = $this->connect();
		$result = $this->readUsers();
		while ($row = $result->fetch_assoc()) {
			array_push($this->users, new User($row["ID"],$row["Name"],$row["Password"],$row["Age"],$row["Phone"]));
		}
	}

	function getUsers() {
		return $this->users;
	}

	function readUsers(){
		$sql = "SELECT * FROM user";

		$result = $this->db->query($sql);
		if ($result->num_rows > 0){
			return $result;
		}
		else {
			return false;
		}
	}

	function addUser($name, $password, $age, $phone){
		$sql = "INSERT INTO user (name, password, age, phone) VALUES ('$name','$password', '$age', '$phone')";
		if($this->db->query($sql) === true){
			echo "Records inserted successfully.";
			$this->fillArray();
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
	}
}


require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/Product.php");

class ProductsModel extends Model {
    private $products; // Change from $users to $products

    function __construct() {
        $this->fillArray(); // Populate the products array on initialization
    }

    function fillArray() {
        $this->products = array(); // Initialize the products array
        $this->db = $this->connect(); // Database connection
        $result = $this->readProducts(); // Get products from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming Product class has a constructor matching the table columns
            array_push($this->products, new Product(
                $row["productId"],
                $row["productName"],
                $row["productDescription"],
                $row["productPrice"],
                $row["stockQuantity"],
                $row["createdAt"],
                $row["productImage"]
            ));
        }
    }

    function getProducts() {
        return $this->products; // Return the products array
    }

    function readProducts() {
        // SQL query to select all products from the products table
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are products
        } else {
            return false; // Return false if no products are found
        }
    }

    function addProduct($productName, $productDescription, $productPrice, $stockQuantity, $productImage) {
        // SQL query to insert a new product into the products table
        $sql = "INSERT INTO products (productName, productDescription, productPrice, stockQuantity, productImage) 
                VALUES ('$productName', '$productDescription', '$productPrice', '$stockQuantity', '$productImage')";
        if ($this->db->query($sql) === true) {
            echo "Product inserted successfully.";
            $this->fillArray(); // Refresh the products array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }

    // You can add more methods like editProduct() or deleteProduct() as needed
}