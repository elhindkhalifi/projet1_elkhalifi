<?php include "../public/header.php";
?>
<a href="../">Accueil</a>
<?php
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once("../functions/addressCrud.php");
require_once ('../functions/functions.php');
session_start();

// Initialiser des variables pour suivre la validation des adresses
$validationBilling = true;  // Validation de l'adresse de facturation
$validationShipping = true; // Validation de l'adresse de livraison

// Validation de l'adresse de facturation
$validationBillingStreet = streetIsValid($_POST["billing_street_nb"]);
$validationBillingZipCode = zipCodeIsValid($_POST["billing_zip_code"]);
$validationBillingStreetName = nameValidation($_POST["billing_street_name"]);


if (!$validationBillingZipCode["isValid"]) {
    $validationBilling = false;

}
if (!$validationBillingStreet["isValid"]) {
    $validationBilling = false;
 
}
if (!$validationBillingStreetName["isValid"]) {
    $validationBilling = false;
 
}

// Validation de l'adresse de livraison
$validationShippingStreet = streetIsValid($_POST["shipping_street_nb"]);
$validationShippingZipCode = zipCodeIsValid($_POST["shipping_zip_code"]);
$validationShippingStreetName = nameValidation($_POST["shipping_street_name"]);

if (!$validationShippingZipCode["isValid"]) {
    $validationShipping = false;
   
}
if (!$validationShippingStreet["isValid"]) {
    $validationShipping = false;
    
}
if (!$validationShippingStreetName["isValid"]) {
    $validationShipping = false;
 
}
if (!$validationBilling ||!$validationShipping) {
    $_SESSION['update_errors_shipping'] = [
        "street_name"=>$validationShippingStreetName["msg"],
       "street_nb"=>$validationShippingStreet["msg"],
       "zip_code"=>$validationShippingZipCode["msg"],
    ];
    $_SESSION['update_errors_billing'] = [
        "street_name"=>$validationBillingStreetName["msg"],
        "street_nb"=>$validationBillingStreet["msg"],
        "zip_code"=>$validationBillingZipCode["msg"],
     ];

    $url = '../authentification/address.php';
    header('Location: ' . $url);

}

// Si les deux adresses sont valides, mettez à jour les adresses de l'utilisateur dans la base de données
if ($validationBilling && $validationShipping) {
    $dataBillingAddress = [
        "street_name" => $_POST["billing_street_name"],
        "street_nb" => $_POST["billing_street_nb"],
        "country" => "canada",
        "province" => $_POST["billing_province"],
        "city" => $_POST["billing_city"],
        "zip_code" => $_POST["billing_zip_code"],
    ];

    $dataShippingAddress = [
        "street_name" => $_POST["shipping_street_name"],
        "street_nb" => $_POST["shipping_street_nb"],
        "country" =>"canada",
        "province" => $_POST["shipping_province"],
        "city" => $_POST["shipping_city"],
        "zip_code" => $_POST["shipping_zip_code"],
    ];
    // Create addresses and get last inserted IDs
    $billingAddressID = createAddress($dataBillingAddress);
    $shippingAddressID = createAddress($dataShippingAddress);
    

    // Mettez à jour les adresses dans la base de données
    updateUserAddresses($conn, $_SESSION['user_id'], $billingAddressID, $shippingAddressID);


    // Afficher le message de succès
    ?>

    <div class="success-message">
        Les adresses ont été mises à jour avec succès.
    </div>
    
    <?php
    }
    ?>
    
    <?php include "../public/footer.php"; ?>

