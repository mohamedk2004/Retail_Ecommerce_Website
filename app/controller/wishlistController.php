<?php

require_once(__ROOT__ . "controller.php");

class WishlistController extends Controller{
    //get all wishlist items
    public function getAllWishlistItems() {
        return $this->model->getWishlistitems(); 
    }
}
?>