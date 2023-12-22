<?php 
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
session_start();
include "../public/header.php";
//using two methods to check wether to use is logged in for now :both token and user logged in sessions 
//todo: only token in one file to call everytime pour rendre le code plus propre

if (!isset($_SESSION['token'])) {
    // Redirect to login if the token is not present
    header("Location: ./authentification/login.php");
    exit();
}
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect tau login quand user pas connecter
    $url = './authentification/login.php';
    header('Location: ' . $url);
    exit();

}
$userName=$_SESSION['user_name'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] === "yes") {
        $usernameToDelete = $_POST["usernameToDelete"];

        // Call the deleteUser function
        $success = deleteUser($usernameToDelete);

        if ($success) {
            // Account deletion successful
            echo "Account deleted successfully!";
            session_unset();

            // Destroy the session
            session_destroy();
            
        } else {
            // Account deletion failed
            echo "Failed to delete the account. Please try again.";
        }
    } elseif (isset($_POST["delete_account"])) {
        $usernameToDelete = $userName; 
       

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Delete Account - Confirm</title>
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

input[type="submit"]{
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
            <center><h2>Delete Account - Confirm</h2>

            <p>Are you sure you want to delete the account with the username '<?php echo $usernameToDelete; ?>'?</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="usernameToDelete" value="<?php echo $usernameToDelete; ?>">
                <input type="hidden" name="confirm_delete" value="yes">
                <input type="submit" name="delete_account" value="Yes, Delete Account">
            </form>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="cancel_delete" value="Cancel">
            </form>
</center>
        </body>
        </html>
        <?php
    } elseif (isset($_POST["cancel_delete"])) {
        // User canceled the deletion, you can redirect or show a message
        echo "Account deletion canceled.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
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

input[type="submit"]{
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
   <center> <h2>Delete Account</h2>
    
    <!-- Your HTML form for account deletion -->
    <form method="post" >
       <h2> <input type="submit" name="delete_account" value="Delete My Account"></h2>
    </form></center>
</body>
</html>
<?php include "../public/footer.php"; ?>
