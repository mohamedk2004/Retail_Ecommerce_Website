<?php

require_once(__ROOT__ . "controller.php");

class PaymentsController extends Controller{
	public function add() {
		$order_id = $_REQUEST['order_id'];
		$amount = $_REQUEST['amount'];
		$payment_method = $_REQUEST['payment_method'];
		$payment_date = $_REQUEST['payment_date'];

		$this->model->addPayment($order_id, $amount, $payment_method, $payment_date);
	}
	
}
?>