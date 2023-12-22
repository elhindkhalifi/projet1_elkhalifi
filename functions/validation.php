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
// product validation functions
function productNameIsValid($name)
{
    // Validate product name
    if (empty($name)) {
        return [
            'isValid' => false,
            'msg' => 'Le nom du produit est requis.'
        ];
    } elseif (strlen($name) < 2 || strlen($name) > 50) {
        return [
            'isValid' => false,
            'msg' => 'Le nom du produit doit contenir entre 2 et 50 caractères.'
        ];
    }

    return [
        'isValid' => true,
        'msg' => ''
    ];
}

function productPriceIsValid($price)
{
    // Validate product price
    if (empty($price)) {
        return [
            'isValid' => false,
            'msg' => 'Le prix du produit est requis.'
        ];
    } elseif (!is_numeric($price) || $price <= 0) {
        return [
            'isValid' => false,
            'msg' => 'Prix du produit invalide.'
        ];
    }

    return [
        'isValid' => true,
        'msg' => ''
    ];
}

function productImgIsValid($img)
{
    // Validate product image URL
    if (empty($img)) {
        return [
            'isValid' => false,
            'msg' => 'L\'URL de l\'image du produit est requise.'
        ];
    } elseif (!filter_var($img, FILTER_VALIDATE_URL)) {
        return [
            'isValid' => false,
            'msg' => 'URL de l\'image du produit invalide.'
        ];
    }

    return [
        'isValid' => true,
        'msg' => ''
    ];
}
function validateProductImage($file)
{
    $result = [
        'isValid' => true,
        'msg' => '',
        'img_url' => ''
    ];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($file['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        $result['isValid'] = false;
        $result['msg'] = "Le fichier n'est pas une image.";
        return $result;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $result['isValid'] = false;
        $result['msg'] = "Désolé, le fichier existe déjà.";
        return $result;
    }

    // Check file size
    if ($file['size'] > 500000) {
        $result['isValid'] = false;
        $result['msg'] = "Désolé, votre fichier est trop volumineux.";
        return $result;
    }

    // Allow certain file formats
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedFormats)) {
        $result['isValid'] = false;
        $result['msg'] = "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        return $result;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $result['isValid'] = false;
        return $result;
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            // File uploaded successfully
            $result['img_url'] = $target_file;
        } else {
            $result['isValid'] = false;
            $result['msg'] = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            return $result;
        }
    }

    return $result;
}


function productDescriptionIsValid($description)
{
    // Validate product description
    if (empty($description)) {
        return [
            'isValid' => false,
            'msg' => 'La description du produit est requise.'
        ];
    } elseif (strlen($description) < 10) {
        return [
            'isValid' => false,
            'msg' => 'La description du produit doit contenir au moins 10 caractères.'
        ];
    }

    return [
        'isValid' => true,
        'msg' => ''
    ];
}


?>

