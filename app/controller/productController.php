<?php

require_once(__ROOT__ . "controller.php");

class ProductController extends Controller{
	public function add() {
		$product_name = $_REQUEST['product_name'];
		$product_description = $_REQUEST['product_description'];
		$product_price = $_REQUEST['product_price'];
		$stock_quantity = $_REQUEST['stock_quantity'];
		$product_image = $_REQUEST['product_image'];

		$this->model->addProduct($product_name, $product_description, $product_price, $stock_quantity, $product_image);
	}

	public function edit() {
		$product_name = $_REQUEST['product_name'];
		$product_description = $_REQUEST['product_description'];
		$product_price = $_REQUEST['product_price'];
		$stock_quantity = $_REQUEST['stock_quantity'];
		$product_image = $_REQUEST['product_image'];

		$this->model->editProduct($product_name, $product_description, $product_price, $stock_quantity, $product_image);
	}
	
	public function delete(){
		$this->model->deleteProduct();
	}
}
?>