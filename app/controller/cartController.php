<?php
require_once 'controller.php'; // Path to the base Controller class
require_once 'models/cartModel.php'; // Path to the CartModel class

class CartController extends Controller
{
    public function __construct() {
        $cartModel = new CartModel();
        parent::__construct($cartModel);
    }

    /**
     * Handle incoming requests.
     */
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_request'])) {
            $this->handleAjaxRequest($_POST['ajax_request']);
        } else {
            $this->displayCart();
        }
    }

    /**
     * Handle AJAX requests.
     */
    private function handleAjaxRequest($request) {
        try {
            switch ($request) {
                case 'add_to_cart':
                    $this->handleAddToCart();
                    break;

                case 'remove_item':
                    $this->handleRemoveItem();
                    break;

                case 'change_quantity':
                    $this->handleChangeQuantity();
                    break;

                case 'update_cart':
                    $this->updateCartContent();
                    break;

                case 'update_cart_count':
                    echo json_encode(['status' => 'success', 'count' => $this->model->getCartCount()]);
                    break;

                default:
                    throw new Exception("Invalid request type.");
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }

    /**
     * Handle adding an item to the cart.
     */
    private function handleAddToCart() {
        $productName = $this->sanitizeInput($_POST['product_name'] ?? '');
        $productPrice = (float) ($_POST['product_price'] ?? 0);
        $productImage = $this->sanitizeInput($_POST['product_image'] ?? '');

        if (empty($productName) || $productPrice <= 0 || empty($productImage)) {
            throw new Exception("Invalid product data.");
        }

        $this->model->addToCart($productName, $productPrice, $productImage);
        echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
    }

    /**
     * Handle removing an item from the cart.
     */
    private function handleRemoveItem() {
        $itemIndex = (int) ($_POST['item_index'] ?? -1);

        if ($itemIndex < 0) {
            throw new Exception("Invalid item index.");
        }

        $this->model->removeFromCart($itemIndex);
        echo json_encode(['status' => 'success', 'message' => 'Item removed from cart']);
    }

    /****
     * Handle changing the quantity of an item in the cart.
     */
    private function handleChangeQuantity() {
        $itemIndex = (int) ($_POST['item_index'] ?? -1);
        $quantityChange = (int) ($_POST['quantity_change'] ?? 0);

        if ($itemIndex < 0 || $quantityChange === 0) {
            throw new Exception("Invalid item index or quantity.");
        }

        $this->model->updateQuantity($itemIndex, $quantityChange);
        echo json_encode(['status' => 'success', 'message' => 'Item quantity updated']);
    }

    /**
     * Sanitize user input.
     */
    private function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    /**
     * Display the cart page.
     */
    public function displayCart() {
        $cart = $this->model->getCart();
        $total = $this->model->calculateTotal();
        include 'views/user/shopping_cart.php'; // Corrected path
    }

    /**
     * Update cart content (used in AJAX requests).
     */
    private function updateCartContent() {
        $cart = $this->model->getCart();
        $total = $this->model->calculateTotal();
        include 'views/user/shopping_cart.php'; // Corrected path
    }
}
?>