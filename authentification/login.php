<?php
session_start(); // Start the session



if ($_SESSION['login_attempts'] >= 3) {
        // TODO:BLOCK IP 
    echo "Too many login attempts. Please try again later.";
    exit;
}
$user_name = '';
if (isset($_SESSION['login_form']['user_name'])) {
    $user_name = $_SESSION['login_form']['user_name'];
}
$pwd = '';
if (isset($_SESSION['login_form']['pwd'])) {
    $pwd = $_SESSION['login_form']['pwd'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h2>Welcome to Inda's</h2>
        <h2>Connexion</h2>
        <a href="../index.php">Retour Accueil</a>
    </center>

    <form method="post" action="../results/loginResult.php">
        <label for="user_name">Nom d'utilisateur :</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $user_name ?>" >
        <br>
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['login_errors']['user_name'])? $_SESSION['login_errors']['user_name'] : '1' ?>
        </p>
        <br>
        <label for="pwd">Mot de Passe :</label>
        <input type="password" id="pwd" name="pwd" value="<?php echo $pwd ?>">
        <br>
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['login_errors']['pwd'])? $_SESSION['login_errors']['pwd'] : '' ?>
        </p>
        <br>
        <input type="submit" value="Log In">
    </form>
</body>
</html>
