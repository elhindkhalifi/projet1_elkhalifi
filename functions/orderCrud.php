<?php 
require_once("../config/connexion.php");
require_once('../functions/userCrud.php');
require_once('../functions/orderCrud.php');
require_once('../functions/addressCrud.php');
require_once('../functions/productCrud.php');
function createOrder($user_id, $total_amount, $cart) {
    global $conn;

    // Insert into user_order table
    $orderRef = generateOrderReference();
    $date = date("Y-m-d");

    $orderQuery = "INSERT INTO user_order (ref, date, total, user_id) 
                   VALUES ('$orderRef', '$date', $total_amount, $user_id)";
    mysqli_query($conn, $orderQuery);

    // Get the order ID
    $order_id = mysqli_insert_id($conn);

    // Insert into order_has_product table
    foreach ($cart as $product_id => $quantity) {
        $product = getProductById($product_id);
        $price = $product['price'];

        $orderItemQuery = "INSERT INTO order_has_product (order_id, product_id, quantity, price) 
                           VALUES ($order_id, $product_id, $quantity, $price)";
        mysqli_query($conn, $orderItemQuery);
    }

    // Clear the cart after placing the order
    $_SESSION['cart'] = array();

    return $order_id;
}

function generateOrderReference() {
    // Generate a unique order reference (you can customize this based on your needs)
    return 'ORDER' . strtoupper(uniqid());
}
function getOrderHistory($user_id) {
    global $conn;

    $query = "SELECT * FROM user_order WHERE user_id = $user_id ORDER BY date DESC";
    $result = mysqli_query($conn, $query);

    $orders = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    return $orders;
}

function calculateTotalPrice($cart) {
    global $conn;
    $totalPrice = 0;

    foreach ($cart as $product_id => $quantity) {
        $product = getProductById($product_id);
        

        $price = (float) $product['price'];

        $quantity = (int) $quantity;

        $totalPrice += $price * $quantity;
    }

    return $totalPrice;
}


// Assume that you have a function to get the user's cart from the session
function getUserCart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }
    return array();
}

// Function to get detailed information about products in the cart
function getCartContents() {
    $cart = getUserCart();
    $cartContents = array();

    // Assume that you have a function to get product details by ID
    foreach ($cart as $product_id => $quantity) {
        $product = getProductById($product_id);

        // Add product details to the cartContents array
        if ($product) {
            $product['quantity'] = $quantity;
            $cartContents[$product_id] = $product;
        }
    }

    return $cartContents;
}
function placeOrder($user_id, $payment_method) {
    global $conn;

    // Check if the user has addresses
    $userDetails = getUserByUsername($_SESSION['user_name']);
    $shippingAddressDetails = getAddressById($userDetails['shipping_address_id']);
    $billingAddressDetails = getAddressById($userDetails['billing_address_id']);
    
    if (empty($shippingAddressDetails) || empty($billingAddressDetails)) {
        return "Error: User does not have addresses. Please add addresses before placing an order.";
    }

    // Get the cart contents
    $cart = getCartContents();

    // Check if the cart is empty
    if (empty($cart)) {
        return "Error: Cart is empty. Add products to the cart before placing an order.";
    }

    // Calculate the total price
    $totalPrice = calculateTotalPrice($cart);

    // Insert order into the database
    $orderRef = generateOrderReference(); 
    
    $insertOrderQuery = "INSERT INTO user_order (ref, date, total, user_id) VALUES ('$orderRef', '$date', $totalPrice, $user_id)";
    mysqli_query($conn, $insertOrderQuery);
    $order_id = mysqli_insert_id($conn);

    // Insert order items into the database
   // Insert order items into the database
foreach ($cart as $product_id => $quantity) {
    $product = getProductById($product_id);
    $price = $product['price'];

    $insertOrderItemQuery = "INSERT INTO order_has_product (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
    mysqli_query($conn, $insertOrderItemQuery);

    // Update product quantity (subtract the ordered quantity)
    $newQuantity = $product['quantity'] - $quantity;
    $updateProductQuery = "UPDATE product SET quantity = $newQuantity WHERE id = $product_id";
    mysqli_query($conn, $updateProductQuery);
}


    // Clear the cart
    $_SESSION['cart'] = array();

    return "Order placed successfully! Order reference: $orderRef";
}


?>


