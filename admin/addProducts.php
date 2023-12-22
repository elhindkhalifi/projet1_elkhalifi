<a href="../">Accueil</a>
<?php
include "../public/header.php";
require_once("../config/connexion.php");
require_once("../functions/productCrud.php");
require_once ('../functions/functions.php');
session_start();
$products = getAllProducts();

if (isset($_SESSION['user_logged_in']) ) {
$name = '';
if (isset($_SESSION['product_form']['name'])) {
    $name = $_SESSION['product_form']['name'];
}



$price = '';
if (isset($_SESSION['product_form']['price'])) {
    $price = $_SESSION['product_form']['price'];
}
$img_url = '';
if (isset($_SESSION['product_form']['img_url'])) {
    $img_url = $_SESSION['product_form']['img_url'];
}
$description = '';
if (isset($_SESSION['product_form']['description'])) {
    $description = $_SESSION['product_form']['description'];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #BDC4CD;
}

center {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}



a {
    color: #4D6881;
    text-decoration: none;
    font-weight: bold;
    display: block; /* Ensures the margin-bottom works properly */
}

form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    margin: auto;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

p {
    color: red;
    font-size: 0.8rem;
}

input[type="submit"] {
    background-color: #4D6881;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #c2185b;
}

    </style>
</head>
<body>
    


<center>
    <h2>Welcome to Inda's</h2>
    <h3>Please enter product info in order to add the product!</h3>
<h2>Adding products </h2>
<a href="../adminHome.php">Retour Acceuil</a>
</center>
<!-- Chaque formulaire a sa page de résultats -->
<form method="post" action="../results/addProductResult.php" enctype="multipart/form-data">
    <div>
        <label for="product_image">Image du produit :</label>
        <input type="file" name="product_image" id="product_image" accept="image/*">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['product_errors']['product_image'])? $_SESSION['product_errors']['product_image'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="description">Description du produit :</label>
        <input id="description" type="text" name="description" value="<?php echo $description ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['product_errors']['description'])? $_SESSION['product_errors']['description'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="name">Nom du produit :</label>
        <input id="name" type="text" name="name" value="<?php echo $name ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['product_errors']['name'])? $_SESSION['product_errors']['name'] : '' ?>
        </p>
    </div>

    <div>
        <label for="price">Prix :</label>
        <input id="price" type="text" name="price" value="<?php echo $price ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['product_errors']['price'])? $_SESSION['product_errors']['price'] : '' ?>  
        </p>
    </div>
    <input type="submit" value="Ajouter Produit">

</form>

<?php
}
include "../public/footer.php";
?>