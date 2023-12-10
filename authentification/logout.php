<?php
// During the logout process
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the acceuil/index page
header("Location:../index.php");
exit();

?>