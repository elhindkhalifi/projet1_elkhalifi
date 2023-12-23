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
//todo:onlysuperadmins can access certain things and add header admin 
require_once("../config/connexion.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
session_start();

// Process the form submission for updating user role
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $user_id = $_POST['id'];

    // Update the user role to admin
    $updateResult = updateUserRole($user_id, 2); 

    if ($updateResult) {
        echo "User role updated successfully!";
    } else {
        echo "Error updating user role.";
    }
}

// Get clients
$users = getClients();
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
                    <div class="button-container">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-success update-role-btn">
                                <i class="bi bi-arrow-repeat"></i> Update Role
                            </button>
                        </form>
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
        width: 30%;
        margin-bottom: 20px;
        text-align: center;
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .update-role-btn {
        color: #fff;
        background-color: #28a745;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
        display: block;
        text-decoration: none;
    }

    .update-role-btn:hover {
        background-color: #218838;
    }

    .button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<?php include "../public/footer.php";?>

