<a href="../">Accueil</a>
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
    $_SESSION['product_form'] = $_POST;

    unset($_SESSION['product_errors']);


    $fieldValidation = true;

    // Validating product name
    if (!empty($_POST['name'])) {
        $nameIsValidData = productNameIsValid($_POST['name']);
        if (!$nameIsValidData['isValid']) {
            $fieldValidation = false;
        }
    }

    // Validating product price
    if (!empty($_POST['price'])) {
        $priceIsValidData = productPriceIsValid($_POST['price']);
        if (!$priceIsValidData['isValid']) {
            $fieldValidation = false;
        }
    }

    // Validating product image

    if (isset($_FILES['product_image'])) {
        $imageValidationResult = validateProductImage($_FILES['product_image']);
        if (!$imageValidationResult['isValid']) {
            $_SESSION['product_errors']['product_image'] = $imageValidationResult['msg'];
            $fieldValidation = false;
        } else {
            $img_url = $imageValidationResult['img_url'];
        }
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
            
        ];
        $newProduct = createProduct($data);
        $url = '../admin/addProducts.php';
        header('Location: ' . $url);
    } else {

        // redirect to signup et donner les messages d'erreur
        $_SESSION['product_errors'] = [
            'name' => $nameIsValidData['msg'],
            'price' => $priceIsValidData['msg'],
            'img' => $imgIsValidData['msg'],
            'description' => $descriptionIsValidData['msg'],

        ];
        $url = '../admin/addProducts.php';
        header('Location: ' . $url);
    }
} else {
    //redirect vers signup
    $url = '../adminHome.php';
    header('Location: ' . $url);
}














// Todo : traiter les données de mon form
// envoyer les données dans la DB
