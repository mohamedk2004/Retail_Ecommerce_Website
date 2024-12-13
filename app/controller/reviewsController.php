<?php

require_once(__ROOT__ . "controller.php");

class ReviewController extends Controller{
	public function add() {
		$product_id = $_REQUEST['product_id'];
		$user_id = $_REQUEST['user_id'];
		$rating = $_REQUEST['rating'];
		$review = $_REQUEST['review'];

		$this->model->addReview($product_id, $user_id, $rating, $review);
	}

	public function edit() {
		$rating = $_REQUEST['rating'];
		$review = $_REQUEST['review'];

		$this->model->editReview($rating, $review);
	}
	
	public function delete(){
		$this->model->deleteReview();
	}
}
?>