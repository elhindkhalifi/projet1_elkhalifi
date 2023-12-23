<?php
require_once("../config/connexion.php");
require_once("../functions/userCrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Call your getUserById function to get the user details
    $user = getUserById($user_id);

    if ($user) {
        // Call your deleteUser function with the user username or ID
        $deleteResult = deleteUser($user['user_name']); // Assuming 'username' is the user identifier

        if ($deleteResult) {
            echo "User deleted successfully!";
            // Optionally, you may redirect the user to the user listing page
            // header("Location: userList.php");
            // exit();
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "User not found.";
    }
}
?>
