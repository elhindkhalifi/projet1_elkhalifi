<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Remove the item from the cart
    unset($_SESSION['cart'][$product_id]);

    // Redirect back to the cart
    header("Location: viewCart.php");
    exit();
}
?>
