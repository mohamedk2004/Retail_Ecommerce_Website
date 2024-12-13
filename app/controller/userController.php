<?php

require_once(__ROOT__ . "controller.php");

class UserController extends Controller{
	public function add() {
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$role = $_REQUEST['role'];
		$address = $_REQUEST['address'];
		$phone = $_REQUEST['phone'];

		$this->model->addUser($firstname, $lastname ,$email, $password, $role, $address, $phone);
	}

	public function edit() {
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
        $address = $_REQUEST['address'];
		$phone = $_REQUEST['phone'];

		$this->model->editUser($firstname, $lastname, $email, $password, $address, $phone);
	}
	
	public function delete(){
		$this->model->deleteUser();
	}
}
?>