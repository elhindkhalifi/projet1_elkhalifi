<?php


session_start(); // Start the session
if (isset($_SESSION['user_logged_in']) ) {
    // Redirect au home quand user est deja connecter
   if( $_SESSION['user_logged_in'] == true){
    $url = '../home.php';
    header('Location: ' . $url);
   }
}
if (isset($_SESSION['login_attempts'])){
if ($_SESSION['login_attempts'] >= 10000000000) {
        // TODO:BLOCK IP 
    echo "Too many login attempts. Please try again later.";
    exit;
}}
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

input[type="submit"] {
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
    <center>
    <h2>Welcome to/Bienvenue chez Inda's</h2>
    <h3>Merci de vous connecter pour pouvoir faire des commandes en ligne</h3>
        <h2>Connexion</h2>
        <a href="../index.php">Retour Accueil</a>
    </center>
    <form method="post" action="../results/loginResult.php">
        <label for="user_name">Nom d'utilisateur :</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $user_name ?>">
        <p><?php echo isset($_SESSION['login_errors']['user_name'])? $_SESSION['login_errors']['user_name'] : '' ?></p>

        <label for="pwd">Mot de Passe :</label>
        <input type="password" id="pwd" name="pwd" value="<?php echo $pwd ?>">
        <p><?php echo isset($_SESSION['login_errors']['pwd'])? $_SESSION['login_errors']['pwd'] : '' ?></p>

        <input type="submit" value="Log In">
    </form>
</body>
</html>
<?php
include "../public/footer.php";
?>