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
    $_SESSION['update_form'] = $_POST;

    unset($_SESSION['update_errors']);

    $fieldValidation = true;


    //valid email
    if (isset($_POST['email'])) {
        $emailIsValidData = emailIsValid($_POST['email']);

        if ($emailIsValidData['isValid'] == false) {
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
        
        $data = [
            'email' => $_POST['email'],
            'fname'=> $_POST['fname'],
            'lname'=> $_POST['lname'],
            
        ];
        $user_name= $_POST['user_name'];
        $newUser = updateUser($data,$user_name);
        $_SESSION['success']="modification faite avec succes!";
        $url = '../authentification/updateUser.php';
        header('Location: ' . $url);
    } else {
        
        // redirect to update et donner les messages d'erreur
        $_SESSION['update_errors'] = [
            'email' => $emailIsValidData['msg'],
            'fname' => $fnameIsValidData['msg'],
            'lname' => $lnameIsValidData['msg'],

        ];
    
        $url = '../authentification/updateUser.php';
        header('Location: ' . $url);
    }
} else {
    //redirect vers update
    $url = '../authentification/updateUser.php';
    header('Location: ' . $url);
}














// Todo : traiter les données de mon form
// envoyer les données dans la DB
