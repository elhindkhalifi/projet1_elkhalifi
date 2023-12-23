<?php include "../public/header.php";?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="header-col">
                <ul>
                    <li><a href="../adminHome.php">Admin Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

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
                    <p><b>Item Description:</b> <?php echo $product['description']; ?></p>
                    <span class="price"><b>Price:</b>$<?php echo $product['price']; ?></span><br>
                    <span class="price"><b>Quantity left:</b> <?php echo $product['quantity']; ?></span><br>
                    <br>
                    <form method="post" action="deleteProduct.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="bi bi-trash-fill"></i> Delete Product
                        </button>
                    </form>
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

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }
</style>

<?php include "../public/footer.php";?>
