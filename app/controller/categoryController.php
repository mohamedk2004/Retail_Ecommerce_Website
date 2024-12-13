<?php

require_once(__ROOT__ . "controller.php");

class CategoryController extends Controller{
	public function add() {
		$category_name = $_REQUEST['category_name'];
		$category_description = $_REQUEST['category_description'];

		$this->model->addCategory($category_name, $category_description);
	}

	public function edit() {
		$category_name = $_REQUEST['category_name'];
		$category_description = $_REQUEST['category_description'];

		$this->model->editCategory($category_name, $category_description);
	}
	
	public function delete(){
		$this->model->deleteCategory();
	}
}
?>