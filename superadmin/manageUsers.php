<?php include "../public/header.php"; ?>

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
require_once("../config/connexion.php");
require_once("../functions/userCrud.php"); // Assuming you have a userCrud.php file
require_once ('../functions/functions.php');
session_start();
$users = getAllUsers(); // Assuming you have a function like getAllUsers() to retrieve user data
?>

<main>
    <section class="users">
        <h1>Users</h1>
        <hr>
        <div class="userContainer">
            <?php foreach ($users as $user) { ?>
                <div class="user">
                    <h2><?php echo $user['user_name']; ?></h2><br>
                    <p><b>Email:</b> <?php echo $user['email']; ?></p>
                    <br>
                    <div class="button-container">
                        <form method="post" action="deleteUser.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-danger delete-btn">
                                <i class="bi bi-trash-fill"></i> Delete User
                            </button>
                        </form>
                        <a href="editUser.php?id=<?php echo $user['id']; ?>" class="btn btn-primary edit-btn">
                            <i class="bi bi-pencil-fill"></i> Edit User
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<style>
    .userContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* or use space-around or space-evenly */
    }

    .user {
        width: 30%; /* Adjust the width as needed */
        margin-bottom: 20px; /* Adjust the margin as needed */
        text-align: center;
    }

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .edit-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: block;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .edit-btn:hover {
        background-color: #0056b3;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
    }
</style>

<?php include "../public/footer.php"; ?>
