
<center>
    <h2>Welcome to/Bienvenue chez Inda's</h2>
    <h3>Merci de vous enregistrer pour pouvoir faire des commandes en ligne</h3>
<h2>Enregistrement </h2>
<a href="../index.php">Retour Acceuil</a>
</center>
<?php 
session_start();
var_dump($_SESSION);

$user_name = '';
if (isset($_SESSION['signup_form']['user_name'])) {
    $user_name = $_SESSION['signup_form']['user_name'];
}

$email = '';
if (isset($_SESSION['signup_form']['email'])) {
    $email = $_SESSION['signup_form']['email'];
}

$pwd = '';
if (isset($_SESSION['signup_form']['pwd'])) {
    $pwd = $_SESSION['signup_form']['pwd'];
}
$fname = '';
if (isset($_SESSION['signup_form']['fname'])) {
    $fname = $_SESSION['signup_form']['fname'];
}
$lname = '';
if (isset($_SESSION['signup_form']['lname'])) {
    $lname = $_SESSION['signup_form']['lname'];
}

$role_id = '';
if (isset($_SESSION['signup_form']['role_id'])) {
    $role_id = $_SESSION['signup_form']['role_id'];
}

?>

<h2>S'enregistrer</h2>
<a href="../">Accueil</a>
<!-- Chaque formulaire a sa page de résultats -->
<form method="post" action="../results/signupResult.php">
    <div>
        <label for="fname">Prenom :</label>
        <input id="fname" type="text" name="fname" value="<?php echo $fname ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['signup_errors']['fname'])? $_SESSION['signup_errors']['fname'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="lname">Nom de famille :</label>
        <input id="lname" type="text" name="lname" value="<?php echo $lname ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['signup_errors']['lname'])? $_SESSION['signup_errors']['lname'] : '' ?>  
        </p>
    </div>
    <div>
        <label for="user_name">Nom d'utilisateur :</label>
        <input id="user_name" type="text" name="user_name" value="<?php echo $user_name ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['signup_errors']['user_name'])? $_SESSION['signup_errors']['user_name'] : '' ?>
        </p>
    </div>
  
    <div>
        <label for="email">Courriel :</label>
        <input id="email" type="text" name="email" value="<?php echo $email ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['signup_errors']['email'])? $_SESSION['signup_errors']['email'] : '' ?>
        </p>
    </div>

    <div>
        <label for="pwd">Mot de passe :</label>
        <input id="pwd" type="text" name="pwd" value="<?php echo $pwd ?>">
        <!-- afficher les erreurs -->
        <p style="color: red; font-size: 0.8rem;">
            <?php echo isset($_SESSION['signup_errors']['pwd'])? $_SESSION['signup_errors']['pwd'] : '' ?>  
        </p>
    </div>

    <button type="submit">S'enregistrer</button>
</form>