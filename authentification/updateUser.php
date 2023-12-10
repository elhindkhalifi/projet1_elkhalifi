<?php
include "../public/headers.php";
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');


 // profile.php
 session_start();
 if (!isset($_SESSION['token'])) {
    // Redirect to login if the token is not present
    header("Location: ./authentification/login.php");
    exit();
}

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect to login if the user is not logged in
    header("Location: ./authentification/login.php");
    exit();
}

// Now, the user is logged in, and you can use other session variables if needed
$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];


// Retrieve the token from the session
$token = $_SESSION['token'];
 // Check if the user is logged in
 if (!isset($_SESSION["user_name"])) {
     header("Location: ./authentification/login.php"); // Redirect to login page if not logged in
     exit();
 }
 
 // Retrieve the username from the session
 $username = $_SESSION["user_name"];
 
 // Now, you can use $username to fetch the user details from the database
 // Perform a database query to retrieve user information based on the username
 
 // Example: Assuming you have a function to get user details from the database
 $userDetails = getUserByUsername($username);
 
 // Display the user information in the form
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Profile</title>
 </head>
 <body>
 
 <h2>User Profile</h2>
 
 <form action="update_profile.php" method="post">
     <!-- Display user information in the form -->
     <label for="name">Name:</label>
     <input type="text" id="name" name="name" value="<?php echo $userDetails['user_name']; ?>">
 
     <label for="email">Email:</label>
     <input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>">
 
     <!-- Add other fields as needed -->
 
     <input type="submit" value="Update Profile">
 </form>
 
 </body>
 </html>
 

