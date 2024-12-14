<?php

require_once(__ROOT__ . "controller.php");

class OrderController extends Controller{
	//add order
    public function add() {
		$user_id = $_REQUEST['user_id'];
		$order_date = $_REQUEST['order_date'];
		$total_amount = $_REQUEST['total_amount'];
		$order_status = $_REQUEST['order_status'];

		$this->model->addOrder($user_id, $order_date, $total_amount, $order_status);
	}

    //edit order status (admin only)
    public function edit() {
		$user_id = $_REQUEST['user_id'];
		$order_date = $_REQUEST['order_date'];
		$total_amount = $_REQUEST['total_amount'];
		$order_status = $_REQUEST['order_status'];

		$this->model->addOrder($user_id, $order_date, $total_amount, $order_status);
	}

    //delete order (cancel order/ returned products)

    //get all order items
    public function getAllOrderItems() {
		if (isset($_REQUEST['order_id'])) {
            $order_id = $_REQUEST['order_id'];
            return $this->model->getOrderItems($order_id); // Pass the order_id to get filtered order items
        } else {
            // If order_id is not provided, return an error or all items as a fallback
            return "Error: order_id is required.";
        }
    }
}
?>