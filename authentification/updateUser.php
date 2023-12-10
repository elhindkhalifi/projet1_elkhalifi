<?php
include "../public/header.php";
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');

//todo:token only in one file to call
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

 $userDetails = getUserByUsername($_SESSION['user_name']);
 
 // Display the user information in the form
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Profile</title>
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

button{
    background-color: #4D6881;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #c2185b;
}

    </style>
 </head>
 <body>
 
 <center><h2>User Profile</h2>
<?php echo isset($_SESSION['success'])? $_SESSION['success'] : ''; unset($_SESSION['success'])?></center>
 
 
 <form method="post" action="../results/updateResult.php">
    <div>
        <label for="fname">Prenom :</label>
        <input id="fname" type="text" name="fname" value="<?php echo $userDetails['fname']; ?>" >
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['update_errors']['fname'])? $_SESSION['update_errors']['fname'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="lname">Nom de famille :</label>
        <input id="lname" type="text" name="lname" value="<?php echo $userDetails['lname']; ?>">
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['update_errors']['lname'])? $_SESSION['update_errors']['lname'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="user_name">Nom d'utilisateur :</label>
        <input id="user_name" type="text" name="user_name" value="<?php echo $userDetails['user_name']; ?>" readonly>
        <p style="color: red; font-size: 0.8rem;">
            champs non modifiable
        </p>
    </div>
  
    <div>
        <label for="email">Courriel :</label>
        <input id="email" type="text" name="email" value="<?php echo $userDetails['email']; ?>">
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['update_errors']['email'])? $_SESSION['update_errors']['email'] : '' ?>
        </p>
    </div>


    <button type="submit">Modifier</button>
</form>
 </body>
 </html>
 
<?php  include "../public/footer.php";
?>
