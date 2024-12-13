<?php

require_once(__ROOT__ . "controller.php");

class OrderController extends Controller{
	public function addOrderItem() {
        $order_id = $_REQUEST['order_id'];
        $product_id = $_REQUEST['product_id'];
        $quantity = $_REQUEST['quantity'];
        $price = $_REQUEST['price'];

        $orderItemsModel = new OrderItemsModel();
        $orderItemsModel->addOrderItem($order_id, $product_id, $quantity, $price);
    }

    public function getOrderItems() {
        $order_id = $_REQUEST['order_id'];

        $order = new Orders($order_id, null); // Initialize with order_id
        $orderItems = $order->getOrderItems();

        return $orderItems;
    }
    
	public function edit() {
        $order_status = $_REQUEST['order_status'];

		$this->model->editOrder($order_status);
	}
	
	public function delete(){
		$this->model->deleteOrder();
	}
}
?>