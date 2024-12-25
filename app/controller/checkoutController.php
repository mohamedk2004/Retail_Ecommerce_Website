<?php
require_once 'model/paymentsModel.php';

class CheckoutController extends Controller {
    private $paymentsModel;
    private $apiKey = "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRBeE16TTFPQ3dpYm1GdFpTSTZJakUzTXpRMk16TXhNamd1TkRNM01qUTJJbjAuNUc2QmRmU1dqMHZvcHY1dWUxNmIxbnJBcllpWkhBLVlKUlhKVGF4MUczTFowdHRVdmdLRGpjT2lubl9HdEtJTE9aX0xtX09BWVpuY1Nac190Y0dnS3c=";
    private $integrationId = "4904971";
    private $iframeId = "889066";

    public function __construct() {
        parent::__construct(new PaymentsModel());
        $this->paymentsModel = new PaymentsModel();
    }

    /**
     * Display the checkout page.
     */
    public function displayCheckout() {
        session_start();
        $cart = $_SESSION['cart'] ?? [];
        $cartTotal = $this->calculateCartTotal($cart);
        include 'view/pages/user/checkout_view.php';
    }

    /**
     * Process the checkout and handle payment.
     */
    public function processCheckout() {
        session_start();
        $cart = $_SESSION['cart'] ?? [];
        $cartTotal = $this->calculateCartTotal($cart);

        // Step 1: Authenticate with Paymob
        $authToken = $this->authenticateWithPaymob();
        if (!$authToken) {
            die("Authentication with Paymob failed.");
        }

        // Step 2: Create the order in Paymob
        $orderId = $this->createOrderInPaymob($authToken, $cart, $cartTotal);
        if (!$orderId) {
            die("Order creation with Paymob failed.");
        }

        // Step 3: Generate payment key
        $paymentKey = $this->generatePaymentKey($authToken, $orderId, $cartTotal);
        if (!$paymentKey) {
            die("Payment key generation failed.");
        }

        // Step 4: Log the payment into the database using PaymentsModel
        $this->paymentsModel->addPayment($orderId, $cartTotal, 'Paymob', date('Y-m-d H:i:s'));

        // Redirect to Paymob iframe for payment
        $iframeUrl = "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}";
        header("Location: $iframeUrl");
        exit();
    }

    /**
     * Calculate the total cost of the cart.
     */
    private function calculateCartTotal($cart) {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    }

    /**
     * Authenticate with Paymob and retrieve an authentication token.
     */
    private function authenticateWithPaymob() {
        $response = $this->makeApiRequest("https://accept.paymob.com/api/auth/tokens", ["api_key" => $this->apiKey]);
        return $response['token'] ?? null;
    }

    /**
     * Create an order in Paymob.
     */
    private function createOrderInPaymob($authToken, $cart, $cartTotal) {
        $response = $this->makeApiRequest("https://accept.paymob.com/api/ecommerce/orders", [
            "auth_token" => $authToken,
            "delivery_needed" => false,
            "amount_cents" => $cartTotal * 100, // Convert to cents
            "currency" => "EGP",
            "items" => array_map(function ($item) {
                return [
                    "name" => $item['name'],
                    "amount_cents" => $item['price'] * 100,
                    "quantity" => $item['quantity']
                ];
            }, $cart)
        ]);
        return $response['id'] ?? null;
    }

    /**
     * Generate a payment key for Paymob.
     */
    private function generatePaymentKey($authToken, $orderId, $cartTotal) {
        $response = $this->makeApiRequest("https://accept.paymob.com/api/acceptance/payment_keys", [
            "auth_token" => $authToken,
            "amount_cents" => $cartTotal * 100,
            "expiration" => 3600,
            "order_id" => $orderId,
            "billing_data" => [
                "apartment" => "NA",
                "email" => "customer@example.com",
                "floor" => "NA",
                "first_name" => "John",
                "last_name" => "Doe",
                "street" => "123 Real Street",
                "building" => "10",
                "phone_number" => "01000000000",
                "shipping_method" => "NA",
                "postal_code" => "12345",
                "city" => "Cairo",
                "country" => "EGY",
                "state" => "NA"
            ],
            "currency" => "EGP",
            "integration_id" => $this->integrationId
        ]);
        return $response['token'] ?? null;
    }

    /**
     * Make an API request to Paymob.
     */
    private function makeApiRequest($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
?>