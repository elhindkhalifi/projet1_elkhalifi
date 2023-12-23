
<?php include "../public/header.php";?>



<?php
require_once("../config/connexion.php");
require_once("../functions/productCrud.php");
require_once ('../functions/functions.php');
session_start();
$products = getAllProducts();
?>

<div class="product">
    <img src="<?php echo $product['img_url']; ?>" class="my_img">
    <h2><?php echo $product['name']; ?></h2><br>
    <p><b>Item Description:</b> <?php echo $product['description']; ?></p>
    <span class="price"><b>Price:</b>$<?php echo $product['price']; ?></span><br>
    <span class="price"><b>Quantity left:</b> <?php echo $product['quantity']; ?></span><br>
    <br>
    <a href="productDetail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">
        <i class="bi bi-eye-fill"></i> View Product
    </a>
    <a href="editProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary">
        <i class="bi bi-pencil"></i> Edit Product
    </a>
    <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
        <i class="bi bi-trash"></i> Delete Product
    </a>
</div>


<style>
    .productContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* or use space-around or space-evenly */
    }

    .product {
        width: 30%; /* Adjust the width as needed */
        margin-bottom: 20px; /* Adjust the margin as needed */
        text-align: center;
    }

    .product img {
        max-width: 50%;
        height: auto;
    }
</style>

<?php include "../public/footer.php";?>
