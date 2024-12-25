<?php
class CheckoutModel {
    public function getCart() {
        session_start();
        return $_SESSION['cart'] ?? [];
    }

    public function calculateTotal() {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart'] ?? []));
    }
}
?>