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

// Include necessary files and initialize session
require_once("../config/connexion.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
session_start();



// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Retrieve user information by ID
    $user = getUserById($user_id);

    // Check if the user exists
    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Check if the form is submitted for updating user information
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $data = array(
            'email' => $_POST['email'],
            'pwd' => $_POST['pwd'],
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'user_name' => $_POST['user_name']
        );

        // Call the updateUserbyAdmin function to update user information
        $updateResult = updateUserbyAdmin($user_id, $data);

        if ($updateResult) {
            echo "User information updated successfully!";
            // Optionally, you may redirect the user to the user listing page
        } else {
            echo "Error updating user information.";
        }
    }
} else {
    echo "User ID not provided.";
    exit();
}
?>

<main>
    <section class="edit-user">
        <h1>Edit User</h1>
        <hr>
        <form method="post" action="editUser.php?id=<?php echo $user_id; ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="pwd">Password:</label>
            <input type="password" name="pwd" value="<?php echo $user['pwd']; ?>" required>

            <label for="fname">First Name:</label>
            <input type="text" name="fname" value="<?php echo $user['fname']; ?>" required>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" value="<?php echo $user['lname']; ?>" required>

            <label for="user_name">Username:</label>
            <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>" required>

            <button type="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-check"></i> Save Changes
            </button>
        </form>
    </section>
</main>

<style>
    .edit-user {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .edit-user form {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    .edit-user label {
        font-weight: bold;
    }

    .edit-user input {
        padding: 8px;
        font-size: 14px;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<?php include "../public/footer.php"; ?>
