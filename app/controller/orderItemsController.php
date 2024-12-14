<?php

require_once(__ROOT__ . "controller.php");

class OrderItemsController extends Controller{
	//add order item
    public function add() {
		$order_id = $_REQUEST['order_id'];
		$product_id = $_REQUEST['product_id'];
		$quantity = $_REQUEST['quantity'];
		$price = $_REQUEST['price'];

		$this->model->addOrderItem($order_id, $product_id, $quantity, $price);
	}

    //edit order item quantity
    public function edit() {
		$quantity = $_REQUEST['quantity'];
		$this->model->editOrderItem($quantity);
	}

    //delete order item (remove from cart)
    public function delete(){
		$this->model->deleteOrderItem();
	}
}
?>