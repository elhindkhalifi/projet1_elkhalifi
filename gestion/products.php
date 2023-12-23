<?php include "../public/header.php";?>

<?php
require_once("../config/connexion.php");
require_once("../functions/productCrud.php");
require_once ('../functions/functions.php');
session_start();
$products = getAllProducts();
?>

<main>
    <section class="products">
        <h1>Products</h1>
        <hr>
        <div class="productContainer">
            <?php foreach ($products as $product) { ?>
                <div class="product">
                    <img src="<?php echo $product['img_url']; ?>" class="my_img">
                    <h2><?php echo $product['name']; ?></h2><br>
                   
                    <a href="productDetail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary view-details-btn">
                        <i class="bi bi-eye-fill"></i> View Details
                    </a>
                    
                    <a href="addToCart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary add-to-cart-btn">
                        <i class="bi bi-cart-plus-fill"></i> Add to Cart
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<style>
    .productContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; 
    }

    .product {
        width: 30%; 
        margin-bottom: 20px; 
        text-align: center;
    }

    .product img {
        max-width: 50%;
        height: auto;
    }

    .view-details-btn,
    .add-to-cart-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        text-decoration: none;
        margin-top: 10px;
        display: block;
    }

    .view-details-btn:hover,
    .add-to-cart-btn:hover {
        background-color: #0056b3;
    }
</style>

<?php include "../public/footer.php";?>


