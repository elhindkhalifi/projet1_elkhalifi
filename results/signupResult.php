<a href="../">Accueil</a>
<?php
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
session_start();



// Todo : valider les données de mon form 
// si les données ne sont pas bonne : renvoyer vers le form d'enregistrement (redirect auto )
// attention on veut récupérer les données rentrées précédement : $_SESSION



if (isset($_POST)) {
    $_SESSION['signup_form'] = $_POST;

    unset($_SESSION['signup_errors']);

    $fieldValidation = true;
    // valid user name
    if (isset($_POST['user_name'])) {
        $nameIsValidData = usernameIsValid($_POST['user_name']);

        if ($nameIsValidData['isValid'] == false) {
            $fieldValidation = false;
        }
    }

    //valid email
    if (isset($_POST['email'])) {
        $emailIsValidData = emailIsValid($_POST['email']);

        if ($emailIsValidData['isValid'] == false) {
            $fieldValidation = false;
        }
    }
    // valid mdp
    if (isset($_POST['pwd'])) {
        $pwdIsValidData = pwdValidation($_POST['pwd']);

        if ($pwdIsValidData['isValid'] == false) {
            $fieldValidation = false;
        }
    }
    if (isset($_POST['fname'])) {
        $fnameIsValidData = nameValidation($_POST['fname']);

        if ($fnameIsValidData['isValid'] == false) {
            $fieldValidation = false;
        }
    }
    if (isset($_POST['lname'])) {
        $lnameIsValidData = nameValidation($_POST['lname']);

        if ($lnameIsValidData['isValid'] == false) {
            $fieldValidation = false;
        }
    }

    if ($fieldValidation == true) {
        //envoyer à la DB
        $saltedPassword= addSalt($_POST['pwd']);
        $encodedPwd = encodePwd($saltedPassword);
        $data = [
            'user_name' => $_POST['user_name'],
            'email' => $_POST['email'],
            'pwd' => $encodedPwd
        ];
        $newUser = createUser($data);
    } else {
        // redirect to signup et donner les messages d'erreur
        $_SESSION['signup_errors'] = [
            'user_name' => $nameIsValidData['msg'],
            'email' => $emailIsValidData['msg'],
            'pwd' => $pwdIsValidData['msg'],
            'fname' => $fnameIsValidData['msg'],
            'lname' => $lnameIsValidData['msg'],

        ];
        $url = '../authentification/signup.php';
        header('Location: ' . $url);
    }
} else {
    //redirect vers signup
    $url = '../authentification/signup.php';
    header('Location: ' . $url);
}














// Todo : traiter les données de mon form
// envoyer les données dans la DB
