<?php
// Cart Routes
$router->post('/cart', 'CartController@handleRequest'); // Handle all cart-related AJAX requests
$router->get('/cart', 'CartController@displayCart'); // Display the shopping cart page

// Optional: Specific Routes for Cart Actions (Granular Control)
$router->post('/cart/add', 'CartController@handleAddToCart'); // Add an item to the cart
$router->post('/cart/remove', 'CartController@handleRemoveItem'); // Remove an item from the cart
$router->post('/cart/update', 'CartController@updateCartContent'); // Update cart content dynamically
$router->post('/cart/change_quantity', 'CartController@handleChangeQuantity'); // Change item quantity in the cart

// Cash on Delivery Checkout Routes
$router->get('/cod_checkout', 'CodCheckoutController@displayForm'); // Display the form
$router->post('/cod_checkout', 'CodCheckoutController@processForm'); // Process form submission
// ajadasdasd

$router->post('/codCheckout', [CodCheckoutController::class, 'processCheckout']);
$router->get('/codCheckout', [CodCheckoutController::class, 'processCheckout']);