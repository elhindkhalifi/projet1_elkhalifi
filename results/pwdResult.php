
<a href="../">Accueil</a>
<?php
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once ('../functions/functions.php');
session_start();

// Todo: validate form data
// If the data is not valid, redirect to the password update form (auto-redirect)
// Ensure we retrieve previously entered data: $_SESSION

if (isset($_POST)) {
    $_SESSION['pwd_update_form'] = $_POST;

    unset($_SESSION['update_errors']);

    $fieldValidation = true;

    // Validate current password
    if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $currentPassword = $_POST['current_password'];
        $saltedPassword= addSalt($currentPassword);
        $encodedPwd = encodePwd($saltedPassword);
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        $userDetails = getUserByUsername($_SESSION['user_name']);
        $pwdIsValidData = pwdValidation($newPassword);
        if (empty($currentPassword)) {
            $fieldValidation = false;
            $error1 = "Le mot de passe actuel est requis.";
        } elseif ($encodedPwd!== $userDetails["pwd"]) {
            $fieldValidation = false;
            $error1 = "Le mot de passe actuel n'est pas correct.";
        }
        if ($pwdIsValidData["isValid"] == false) {
            $fieldValidation = false;
        }
        if (empty($newPassword) || empty($confirmPassword)) {
            $fieldValidation = false;
            $error2 = "Veuillez fournir les nouveaux mots de passe.";
        } elseif ($newPassword !== $confirmPassword) {
            $fieldValidation = false;
            $error2 = "Les nouveaux mots de passe ne correspondent pas.";}

    if ($fieldValidation) {
        //envoyer à la DB
        $saltedPassword= addSalt($newPassword);
        $encodedPwd = encodePwd($saltedPassword);
        $data = [
            'email' => $userDetails['email'],
            'fname'=> $userDetails['fname'],
            'lname'=> $userDetails['lname'],
            'pwd' => $encodedPwd,
        ];

        $user_name = $_SESSION['user_name'];
        $result = updateUser($data,$user_name);

        if ($result) {
            $_SESSION['success'] = "Mot de passe modifié avec succès!";
            $url = '../authentification/updatePwd.php'; 
            header('Location: ' . $url);
        } else {
            $_SESSION['update_errors']['password'] = "Échec de la mise à jour du mot de passe.";
            $url = '../authentification/updatePwd.php'; 
            header('Location: ' . $url);
        }
    } else {
        // Redirect to the password update form and provide error messages
        $_SESSION['update_errors'] = [
            'current_password' =>$error1,
            'confirm_password' =>$error2,
            'new_password' => $pwdIsValidData['msg'],

        ];
        $url = '../authentification/updatePwd.php'; // Update this path accordingly
        header('Location: ' . $url);
    }
} else {
    // Redirect to the password update form
    $url = '../authentification/updatePassword.php'; // Update this path accordingly
    header('Location: ' . $url);
}
}