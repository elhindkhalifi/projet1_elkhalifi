<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['action'])) {
    $product_id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == "increase") {
        // Increase quantity
        $_SESSION['cart'][$product_id]++;
    } elseif ($action == "decrease") {
        // Decrease quantity, but not below 1
        if ($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        }
    }

    // Redirect back to the cart
    header("Location: viewCart.php");
    exit();
}
?>
