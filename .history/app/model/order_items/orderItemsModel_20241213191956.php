<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "orderitems.php");

class OrderItemsModel extends Model {
	private $orderItems; 

    function __construct() {
        $this->fillArray(); // Populate the orderItems array on initialization
    }

    function fillArray() {
        $this->orderItems = array(); // Initialize the orderItems array
        $this->db = $this->connect(); // Database connection
        $result = $this->readOrderItems(); // Get orderItems from the database
        while ($row = $result->fetch_assoc()) {
            // Assuming order_items class has a constructor matching the table columns
            array_push($this->orderItems, new OrderItem(
                $row["order_items_id"],
                $row["order_id"],
                $row["product_id"],
                $row["quantity"],
                $row["price"],
            ));
        }
    }

    function getOrderItems() {
        return $this->orderItems; // Return the orderItems array
    }

    function readOrderItems() {
        // SQL query to select all orderItems from the orderItems table
        $sql = "SELECT * FROM order_id";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are orderItems
        } else {
            return false; // Return false if no orderItems are found
        }
    }

    function addOrderItem($order_id, $product_id, $quantity, $price) {
        // SQL query to insert a new order_item into the orderItems table
        $sql = "INSERT INTO orderItems (order_id, product_id, quantity, price) 
                VALUES ('$order_id',$product_id', '$quantity', '$price')";
        if ($this->db->query($sql) === true) {
            echo "Order Item inserted successfully.";
            $this->fillArray(); // Refresh the orderItems array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
}