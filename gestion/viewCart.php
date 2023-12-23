<?php
include "../public/header.php"; 
require_once("../config/connexion.php");
require_once("../functions/productCrud.php");
require_once ('../functions/functions.php');
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<center><h1>Shopping Cart</h1>";
    echo "Your cart is empty.</center>";
} else {
    echo "<center><h1>Shopping Cart</h1>";
    echo "<ul>";

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product details based on product ID
        $product = getProductById($product_id);

        if ($product) {
            echo "<li>";
            echo "<img src='{$product['img_url']}' alt='{$product['name']}' style='max-width: 50px; height: auto;'> ";
            echo "<b>{$product['name']}</b>, Quantity: $quantity ";
            echo "<a href='modifyQuantity.php?id=$product_id&action=increase'>+</a> ";
            echo "<a href='modifyQuantity.php?id=$product_id&action=decrease'>-</a> ";
            echo "<a href='removeFromCart.php?id=$product_id'>Remove</a>";
            echo "</li>";
        }
    }

    echo "</ul></center>";
}

include "../public/footer.php";
?>


