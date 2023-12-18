<?php
include "./public/header.php";?>
<header class="header">
<div class="container">
 <div class="row">
   <div class="header-col">
     <ul>
       <li><a href="./adminHome.php">Admin Home</a></li>
     </ul>
   </div>
 </div>
</div>
</header>
<?php
//using two methods to check wether to use is logged in for now :both token and user logged in sessions 
//todo: only token in one file to call eveerytime pour rendre le code plus propre
session_start();
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
?>


<!-- Sidebar Section -->
<section style="background-color: #2D2D2D; color: #ffffff; padding: 20px; text-align: center;align-items: center;">

     <h2>Admin Functions</h2>
     <div class="container">
  	 	<div class="row">
                   <div class="footer-col">
                   <h4>Functions on products</h4>
  	 			<ul>
  	 				<li><a href="./admin/addProducts.php">Add products</a></li>
                    <li><a href="./superadmin/manageProducts.php">Manage products</a></li>
                    </div>
                <div class="footer-col">
                   <h4>Functions on users</h4>
  	 			<ul>
  	 				<li><a href="./admin/updateRole.php">Update user roles</a></li>
                    <li><a href="./admin/deleteUser.php">Delete user</a></li>
                    <li><a href="./superadmin/manageUsers.php">Manage all user infos</a></li>
  	 			</ul>
                <br>
                   </div>
                <div class="footer-col">
                   <h4>My profile</h4>
  	 			<ul>
                    <li><a href="./authentification/updateUser.php">Edit My Profile Info</a></li>
  	 				<li><a href="./authentification/updatePwd.php">Reset My Password</a></li>
                    <li><a href="./authentification/logout.php">Logout</a></li>
                    <li><a href="./authentification/deleteUser.php">Delete My Account</a></li>
  	 			</ul>
                <br>
                </div>

</section>




<?php
include "./public/footer.php";
?>