<?php

function usernameIsValid(string $username): array
{
    $result = [
        'isValid' => true,
        'msg' => ''

    ];

    $userInDB = getUserByUsername($username);

    if (strlen($username) < 2 && strlen($username) > 0) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom utilisé est trop court'

        ];
    } elseif (strlen($username) > 20) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom utilisé est trop long'

        ];
    } elseif ($userInDB) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom est déjà utilisé'
        ];
    } elseif (empty($username))  {
        $result = [
            'isValid' => false,
            'msg' => 'Ce champs est requis'
        ];
    }
    return $result;
}

function emailIsValid($email)
{

    $email_validation_regex = "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";
    if (empty($email)) {
        return [
            'isValid' => false,
            'msg' => 'Ce champ est requis',
        ];
    } elseif (!preg_match($email_validation_regex, $email)) {
        return [
            'isValid' => false,
            'msg' => "Format d'email invalide",
        ];
    }

    return [
        'isValid' => true,
        'msg' => '',
    ];
}

function pwdValidation($pwd)
{
    //minimum 6 max 16
    $length = strlen($pwd);
    if (empty($pwd))  {
        return [
            'isValid' => false,
            'msg' => 'Ce champ est requis'
        ];
    } elseif ($length < 6 && $length > 0) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop court. Doit être supérieur à 6 caractères'
        ];
    } elseif ($length > 16) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop long. Doit être inférieur à 16 caractères'
        ];
    }
    return [
        'isValid' => true,
        'msg' => ''
    ];
}
function nameValidation($name)
{
    
    if (empty($name))  {
        return [
            'isValid' => false,
            'msg' => 'Ce champ est requis'
        ];}
  
    return [
        'isValid' => true,
        'msg' => ''
    ];
}

//validation du zipcode
function zipCodeIsValid($zipcode): array
{
    $result = [
        'isValid' => true,
        'msg' => ''
    ];
    echo '<br><br>';
    if (strlen($zipcode) !=6 ) {
        $result = [
            'isValid' => false,
            'msg' => "le code postale utilisé doit contenir exactement 6 caracteres."
        ];
    }
    return $result;
};
//validation de street
function  streetIsValid( $street): array
{
    $result = [
        'isValid' => true,
        'msg' => ''
    ];
    echo '<br><br>';
    if (is_numeric($street)){
    if (strlen($street) > 50) {
        $result = [
            'isValid' => false,
            'msg' => "Le numéro de rue utilisé est trop long."
        ];
        }
    }elseif(empty($street)){
        $result = [
            'isValid' => false,
            'msg' => "Le numéro de rue est requis."
        ];
    }elseif(!is_numeric($street)){
        $result = [
            'isValid' => false,
            'msg' => "Le numéro de rue doit etre un nombre."
        ];
    }
    return $result;
}

?>