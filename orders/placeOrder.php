<?php
session_start();
require_once("../config/connexion.php");
require_once('../functions/userCrud.php');
require_once('../functions/orderCrud.php');
require_once('../functions/addressCrud.php');
require_once('../functions/productCrud.php');



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle accordingly
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$userDetails=getUserByUsername($user_id);
// Check if the user has addresses
$userDetails = getUserByUsername($_SESSION['user_name']);
$shippingAddressDetails= getAddressbyId($userDetails['shipping_address_id']);
$billingAddressDetails= getAddressbyId($userDetails['billing_address_id']);
if (empty($shippingAddressDetails)||empty($billingAddressDetails)) {
    // Redirect to the address page to add or update addresses
    header("Location: ../authentification/address.php");
    exit();
}

// Get the cart contents
$cart = getCartContents();

// Check if the cart is not empty
if (empty($cart)) {
    // Redirect to the products page or handle accordingly
    header("Location: products.php");
    exit();
}

// Calculate the total price of the items in the cart
$totalPrice = calculateTotalPrice($cart);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the payment method and any other necessary steps
    // ...
    $payment_method="";
    // Place the order
    $order_id = placeOrder($user_id,$payment_method);

    // Redirect to the order confirmation page
    header("Location: orderConfirmation.php?id=$order_id");
    exit();
}

include "../public/header.php"; 
// Include your header and any other necessary HTML structure here
?>

<main>
    <section class="place-order">
        <h2>Place Order</h2>
        <p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>

      
        <form method="post" action="">
    
        <label for="payment_method">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
             
            </select>
            <input type="submit" value="Place Order">
        </form>
    </section>
</main>

<?php
include "../public/footer.php";
?>
