<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "orders.php");

class OrdersModel extends Model {
	private $orders; 

    function __construct() {
        $this->fillArray(); // Populate the orders array on initialization
    }

    function fillArray() {
        $this->orders = array();
        $this->db = $this->connect();
        $result = $this->readOrders();
    
        while ($row = $result->fetch_assoc()) {
            $order = new Orders(
                $row["order_id"],
                $row["user_id"],
                $row["order_date"],
                $row["total_amount"],
                $row["order_status"]
            );
    
            // Load and assign order items to the order
            $orderItems = $order->getOrderItems();
            $order->orderItems = $orderItems; // Add a property to hold order items
    
            $this->orders[] = $order;
        }
    }
    

    function getOrders() {
        return $this->orders; // Return the orders array
    }

    function readOrders() {
        // SQL query to select all orders from the orders table
        $sql = "SELECT * FROM orders";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result; // Return the result set if there are orders
        } else {
            return false; // Return false if no orders are found
        }
    }

    function addOrder($user_id, $order_date, $total_amount, $order_status) {
        // SQL query to insert a new order into the orders table
        $sql = "INSERT INTO orders (user_id, order_date, total_amount, order_status) 
                VALUES ('$user_id',$order_date', '$total_amount', '$order_status')";
        if ($this->db->query($sql) === true) {
            echo "Order inserted successfully.";
            $this->fillArray(); // Refresh the orders array
        } else {
            echo "ERROR: Could not execute $sql. " . $this->db->error;
        }
    }
    
    function getOrderItems($order_id)
    {
        $orderItemsModel = new OrderItemsModel();
        return $orderItemsModel->getOrderItemsByOrderId($order_id);
    }
}