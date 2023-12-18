<?php
include "../public/header.php";
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
require_once ('../functions/addressCrud.php');

//todo:token only in one file to call
 session_start();
// Check if the user is logged in
//check1
 if (!isset($_SESSION['token'])) {
    // Redirect to login if the token is not present
    header("Location: ./authentification/login.php");
    exit();
}
// Retrieve the token from the session
$token = $_SESSION['token'];

//check2
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect to login if the user is not logged in
    header("Location: ./authentification/login.php");
    exit();
}

 // Check3
 if (!isset($_SESSION["user_name"])) {
     header("Location: ./authentification/login.php"); // Redirect to login page if not logged in
     exit();
    
 }


 // Now, the user is logged in
$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

$userDetails = getUserByUsername($_SESSION['user_name']);
$shippingAddressDetails= getAddressbyId($userDetails['shipping_address_id']);
$billingAddressDetails= getAddressbyId($userDetails['billing_address_id']);


 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Address Form</title>
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

        select, input {
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
<!-- formulaire avec des champs preremplies si les adresses sont deja ajoutees -->
<form method="post" action="../results/addressResult.php">
    <center>
        <h2>Billing address</h2>
    </center>
    <div>
        <label for="billing_street_name">Street Name :</label>
        <input id="billing_street_name" type="text" name="billing_street_name" value="<?php echo isset($billingAddressDetails['street_name']) ? $billingAddressDetails['street_name'] : ''; ?>" >
        <p>
            <?php echo isset($_SESSION['update_errors']['street_name']) ? $_SESSION['update_errors']['street_name'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="billing_street_nb">Street Number :</label>
        <input id="billing_street_nb" type="text" name="billing_street_nb" value="<?php echo isset($billingAddressDetails['street_nb']) ? $billingAddressDetails['street_nb'] : ''; ?>">
        <p>
            <?php echo isset($_SESSION['update_errors']['street_nb']) ? $_SESSION['update_errors']['street_nb'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="billing_city">City :</label>
        <select id="billing_city" name="billing_city">
            <option value="Montreal" <?php echo (isset($billingAddressDetails['city']) && $billingAddressDetails['city'] === 'Montreal') ? 'selected' : ''; ?>>Montreal</option>
            <option value="Ottawa" <?php echo (isset($billingAddressDetails['city']) && $billingAddressDetails['city'] === 'Ottawa') ? 'selected' : ''; ?>>Ottawa</option>
            <option value="Vancouver" <?php echo (isset($billingAddressDetails['city']) && $billingAddressDetails['city'] === 'Vancouver') ? 'selected' : ''; ?>>Vancouver</option>
            <option value="Toronto" <?php echo (isset($billingAddressDetails['city']) && $billingAddressDetails['city'] === 'Toronto') ? 'selected' : ''; ?>>Toronto</option>
            <option value="Quebec City" <?php echo (isset($billingAddressDetails['city']) && $billingAddressDetails['city'] === 'Quebec City') ? 'selected' : ''; ?>>Quebec City</option>
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['city']) ? $_SESSION['update_errors']['city'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="billing_province">Province :</label>
        <select id="billing_province" name="billing_province">
            <option value="AB" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'AB') ? 'selected' : ''; ?>>Alberta</option>
            <option value="BC" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'BC') ? 'selected' : ''; ?>>British Columbia</option>
            <option value="MB" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'MB') ? 'selected' : ''; ?>>Manitoba</option>
            <option value="NB" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'NB') ? 'selected' : ''; ?>>New Brunswick</option>
            <option value="NL" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'NL') ? 'selected' : ''; ?>>Newfoundland and Labrador</option>
            <option value="NS" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'NS') ? 'selected' : ''; ?>>Nova Scotia</option>
            <option value="ON" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'ON') ? 'selected' : ''; ?>>Ontario</option>
            <option value="PE" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'PE') ? 'selected' : ''; ?>>Prince Edward Island</option>
            <option value="QC" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'QC') ? 'selected' : ''; ?>>Quebec</option>
            <option value="SK" <?php echo (isset($billingAddressDetails['province']) && $billingAddressDetails['province'] === 'SK') ? 'selected' : ''; ?>>Saskatchewan</option>
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['province']) ? $_SESSION['update_errors']['province'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="billing_zip_code">ZIP Code :</label>
        <input id="billing_zip_code" type="text" name="billing_zip_code" value="<?php echo isset($billingAddressDetails['zip_code']) ? $billingAddressDetails['zip_code'] : ''; ?>">
        <p>
            <?php echo isset($_SESSION['update_errors']['zip_code']) ? $_SESSION['update_errors']['zip_code'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="billing_country">Country :</label>
        <select id="billing_country" name="billing_country" disabled>
            <option value="Canada" <?php echo (isset($billingAddressDetails['country']) && $billingAddressDetails['country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['country']) ? $_SESSION['update_errors']['country'] : ''; ?>  
        </p>
    </div>

    <center>
        <h2>Shipping address</h2>
    </center>
    <div>
        <label for="shipping_street_name">Street Name :</label>
        <input id="shipping_street_name" type="text" name="shipping_street_name" value="<?php echo isset($shippingAddressDetails['street_name']) ? $shippingAddressDetails['street_name'] : ''; ?>">
        <p>        
            <?php echo isset($_SESSION['update_errors']['street_name']) ? $_SESSION['update_errors']['street_name'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="shipping_street_nb">Street Number :</label>
        <input id="shipping_street_nb" type="text" name="shipping_street_nb" value="<?php echo isset($shippingAddressDetails['street_nb']) ? $shippingAddressDetails['street_nb'] : ''; ?>">
        <p>
            <?php echo isset($_SESSION['update_errors']['street_nb']) ? $_SESSION['update_errors']['street_nb'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="shipping_city">City :</label>
        <select id="shipping_city" name="shipping_city">
            <option value="Montreal" <?php echo (isset($shippingAddressDetails['city']) && $shippingAddressDetails['city'] === 'Montreal') ? 'selected' : ''; ?>>Montreal</option>
            <option value="Ottawa" <?php echo (isset($shippingAddressDetails['city']) && $shippingAddressDetails['city'] === 'Ottawa') ? 'selected' : ''; ?>>Ottawa</option>
            <option value="Vancouver" <?php echo (isset($shippingAddressDetails['city']) && $shippingAddressDetails['city'] === 'Vancouver') ? 'selected' : ''; ?>>Vancouver</option>
            <option value="Toronto" <?php echo (isset($shippingAddressDetails['city']) && $shippingAddressDetails['city'] === 'Toronto') ? 'selected' : ''; ?>>Toronto</option>
            <option value="Quebec City" <?php echo (isset($shippingAddressDetails['city']) && $shippingAddressDetails['city'] === 'Quebec City') ? 'selected' : ''; ?>>Quebec City</option>
          
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['city']) ? $_SESSION['update_errors']['city'] : ''; ?>
        </p>
    </div>
    <div>
        <label for="shipping_province">Province :</label>
        <select id="shipping_province" name="shipping_province">
            <option value="AB" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'AB') ? 'selected' : ''; ?>>Alberta</option>
            <option value="BC" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'BC') ? 'selected' : ''; ?>>British Columbia</option>
            <option value="MB" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'MB') ? 'selected' : ''; ?>>Manitoba</option>
            <option value="NB" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'NB') ? 'selected' : ''; ?>>New Brunswick</option>
            <option value="NL" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'NL') ? 'selected' : ''; ?>>Newfoundland and Labrador</option>
            <option value="NS" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'NS') ? 'selected' : ''; ?>>Nova Scotia</option>
            <option value="ON" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'ON') ? 'selected' : ''; ?>>Ontario</option>
            <option value="PE" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'PE') ? 'selected' : ''; ?>>Prince Edward Island</option>
            <option value="QC" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'QC') ? 'selected' : ''; ?>>Quebec</option>
            <option value="SK" <?php echo (isset($shippingAddressDetails['province']) && $shippingAddressDetails['province'] === 'SK') ? 'selected' : ''; ?>>Saskatchewan</option>
       
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['province']) ? $_SESSION['update_errors']['province'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="shipping_zip_code">ZIP Code :</label>
        <input id="shipping_zip_code" type="text" name="shipping_zip_code" value="<?php echo isset($shippingAddressDetails['zip_code']) ? $shippingAddressDetails['zip_code'] : ''; ?>">
        <p>
            <?php echo isset($_SESSION['update_errors']['zip_code']) ? $_SESSION['update_errors']['zip_code'] : ''; ?>  
        </p>
    </div>
    <div>
        <label for="shipping_country">Country :</label>
        <select id="shipping_country" name="shipping_country">
            <option value="Canada" <?php echo (isset($shippingAddressDetails['country']) && $shippingAddressDetails['country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
        </select>
        <p>
            <?php echo isset($_SESSION['update_errors']['country']) ? $_SESSION['update_errors']['country'] : ''; ?>  
        </p>
    </div>

    <input type="submit" value="Submit">
</form>

</body>
</html>

<?php include "../public/footer.php";
?>