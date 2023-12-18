
<a href="../">Accueil</a>
<?php
include "../public/header.php";
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
                    <h2>
                        <?php echo $product['name']; ?>
                    </h2><br>
                    <p><b>Item Description:</b>
                        <?php echo $product['description']; ?>
                    </p>
                    <span class="price"><b>Price:</b>$
                        <?php echo $product['price']; ?>
                    </span><br>
                    <span class="price"><b>Quantity left:</b>
                        <?php echo $product['quantity']; ?>
                    </span><br>
                    <br>
                    <a href="productDetail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary"><i
                            class="bi bi-eye-fill"></i> View Product</a>
                </div>


            <?php } ?>
        </div>

    </section>
</main>

<?php
include "../public/footer.php";
?>