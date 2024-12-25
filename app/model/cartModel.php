<?php
class CartModel {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    /**
     * Add an item to the cart.
     */
    public function addToCart($name, $price, $image, $quantity = 1) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $name) {
                $item['quantity'] += $quantity;
                return;
            }
        }
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }

    /**
     * Remove an item from the cart by index.
     */
    public function removeFromCart($index) {
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    /**
     * Update the quantity of an item in the cart by index.
     */
    public function updateQuantity($index, $quantityChange) {
        if (isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['quantity'] += $quantityChange;
            if ($_SESSION['cart'][$index]['quantity'] <= 0) {
                $this->removeFromCart($index);
            }
        }
    }

    /**
     * Get all items in the cart.
     */
    public function getCart() {
        return $_SESSION['cart'];
    }

    /**
     * Calculate the total cost of the cart.
     */
    public function calculateTotal() {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart']));
    }

    /**
     * Get the total number of items in the cart.
     */
    public function getCartCount() {
        return array_sum(array_map(function ($item) {
            return $item['quantity'];
        }, $_SESSION['cart']));
    }
}
?>