<?php
include "../public/header.php";?>
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
require_once("../functions/validation.php");
require_once("../functions/ProductCrud.php");
require_once ('../functions/functions.php');
session_start();



// Todo : valider les données de mon form 
// si les données ne sont pas bonne : renvoyer vers le form d'enregistrement (redirect auto )
// attention on veut récupérer les données rentrées précédement : $_SESSION



if (isset($_POST)) {
    unset($_SESSION['product_errors']);

    $_SESSION['product_form'] = $_POST;



    $fieldValidation = true;

    // Validating product name
   
        $nameIsValidData = productNameIsValid($_POST['name']);
        if (!$nameIsValidData['isValid']) {
            $fieldValidation = false;
        }
    

    // Validating product price
    
        $priceIsValidData = productPriceIsValid($_POST['price']);
        if (!$priceIsValidData['isValid']) {
            $fieldValidation = false;
        }
    

    // Validating product image

   
        $imageValidationResult = validateProductImage($_FILES['product_image']);
        if (!$imageValidationResult['isValid']) {
            $_SESSION['product_errors']['product_image'] = $imageValidationResult['msg'];
            $fieldValidation = false;
        } else {
            $fieldValidation = true;

            $img_url = $imageValidationResult['img_url'];
        }
    //validating product quantity
    $quantityIsValidData = productquantityIsValid($_POST['quantity']);
        if (!$quantityIsValidData['isValid']) {
            $fieldValidation = false;
        }

    // Validating product description
    if (!empty($_POST['description'])) {
        $descriptionIsValidData = productDescriptionIsValid($_POST['description']);
        if (!$descriptionIsValidData['isValid']) {
            $fieldValidation = false;
        }
    }

    if ($fieldValidation == true) {
        //envoyer à la DB
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'img_url' => $img_url,
            'description'=> $_POST['description'],
            'quantity'=>$_POST['quantity']
            
        ];
        $newProduct = createProduct($data);
      echo"product added succesfully";
    } else {

        // redirect to addproducts et donner les messages d'erreur
        $_SESSION['product_errors'] = [
            'name' => $nameIsValidData['msg'],
            'price' => $priceIsValidData['msg'],
            'product_image' =>  $imageValidationResult['msg'],
            'description' => $descriptionIsValidData['msg'],
            'quantity'=>$quantityIsValidData['msg'],

        ];
        $url = '../admin/addProducts.php';
        header('Location: ' . $url);
    }
} else {
    //redirect vers home
    $url = '../adminHome.php';
    header('Location: ' . $url);
}














// Todo : traiter les données de mon form
// envoyer les données dans la DB
