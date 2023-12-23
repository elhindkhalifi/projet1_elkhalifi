<?php
require_once("../config/connexion.php");
require_once("../functions/productCrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Call your deleteProduct function
    $deleteResult = deleteProduct($product_id);

    if ($deleteResult) {
        echo "Product deleted successfully!";
       
    } else {
        echo "Error deleting product.";
    }
}
?>
