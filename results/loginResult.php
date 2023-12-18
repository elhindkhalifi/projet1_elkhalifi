<a href="../">Accueil</a>
<h2>Login result</h2>
<?php

require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');

session_start(); // Start the session


//Authentification

if (isset($_POST)) {
    unset($_SESSION['login_errors']);
    var_dump($_POST);

    $fieldValidation = true;
    $pwdError="";
    $nameError="";
        //vérifier si username dans DB
        if (!empty($_POST['user_name'])) {
            $userData = getUserByUsername($_POST['user_name']);
            //si l'utilisateur exist dans la DB
            if ($userData) {
                // comparer pwd avec DB (version encodée)
                $saltedpwd=addSalt($_POST['pwd']);
                $enteredPwdEncoded = encodePwd($saltedpwd);
                if ($userData['pwd'] == $enteredPwdEncoded) {
                    $fieldValidation = true;
                    // Generate and save a token
                    $token = hash('sha256', random_bytes(32));
            
                    // Save the token in the session
                    $_SESSION['token'] = $token;
            
                    // Save the token in the database (update the user's token)
                    updateUserToken($userData['id'], $token);
            
                    echo '</br></br>Mon token : </br>';
                    var_dump($token);
                   
                    $_SESSION['user_logged_in'] = true;
                    // storing user info in session
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['user_name'] = $userData['user_name'];
                    //if an admin or superadmin or client logs in          
                        if ($userData['role_id'] == 2) {
                            header('Location:../adminHome.php');
                            exit();
                        }elseif ($userData['role_id'] == 1) {
                            header('Location: ../adminHome.php');
                            exit();
                        }else{
                        $url = '../home.php';
                        header('Location: ' . $url);}
                }else {
                    $fieldValidation = false;
                    $_SESSION['login_attempts']++;
                    // Display an error message
                    $pwdError= "Mot de passe incorrect. Essaie ".$_SESSION['login_attempts']." sur 3.<br> <a href='resetPwd.php'>mot de passe oublie?</a> ";
                
            }}else{
                $fieldValidation = false;
                $nameError="aucun utilisateur trouve avec ce nom dutilisateur";
                } 
        }elseif (empty($_POST['user_name'])) {
            $fieldValidation = false;
            $nameError="Ce champ est requis";

        }elseif(empty($_POST['pwd'])){
             $fieldValidation = false;
            $pwdError="Ce champ est requis";
             }
         if ($fieldValidation==false){
             $_SESSION['login_errors'] = [
                 'user_name' =>  $nameError,
                 'pwd'=> $pwdError,
             ];
             // Redirect vers login
             $url = '../authentification/login.php';
             header('Location: ' . $url);
             var_dump($_SESSION['login_errors']);
        }else{
            $_SESSION['user_logged_in'] = true;
            // You can store other user-related information in the session if needed
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['user_name'];
            $url = '../home.php';
            header('Location: ' . $url);
        }
    }

else {
    //redirect vers login
    $url = '../authentification/login.php';
    header('Location: ' . $url);
}











?>