<?php
require_once("../config/connexion.php");
require_once("../functions/userCrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Call your getUserById function to get the user details
    $user = getUserById($user_id);

    if ($user) {
        $deleteResult = deleteUser($user['user_name']); 

        if ($deleteResult) {
            echo "User deleted successfully!";
           
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "User not found.";
    }
}
?>
