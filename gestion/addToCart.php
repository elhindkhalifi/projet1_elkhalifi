<?php
session_start();

// Check if the product ID is provided in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if the product is already in the cart
    if (!isset($_SESSION['cart'][$product_id])) {
        // If not, add it with a quantity of 1
        $_SESSION['cart'][$product_id] = 1;

        // Set a success message
        $_SESSION['cart_message'] = "Product added to cart successfully!";
    } else {
        // If yes, increment the quantity
        $_SESSION['cart'][$product_id]++;

        // Set a success message
        $_SESSION['cart_message'] = "Product quantity increased in the cart!";
    }

    // Redirect back to the product detail page
    header("Location: productDetail.php?id={$product_id}");
    exit();
} else {
    // Handle the case where the product ID is not provided
    header("Location: error.php");
    exit();
}
?>

