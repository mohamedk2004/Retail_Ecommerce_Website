<?php

require_once(__ROOT__ . "controller.php");

class WishlistItemsController extends Controller{
	//add wishlist item (favorite product)
    public function add() {
		$wishlist_id = $_REQUEST['wishlist_id'];
		$product_id = $_REQUEST['product_id'];

		$this->model->addWishlistItem($wishlist_id, $product_id);
	}
    

    //delete wishlist item (unfavorite product)
    public function delete(){
		$this->model->deleteWishlistItem();
	}
}
?>