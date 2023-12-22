<?php

//creer un utilisateur
function createUser(array $data)
{
    global $conn;
    
    $query = "INSERT INTO user(id,name,email,pwd,fname,lname, role_id) VALUES (NULL, ?, ?, ?, ?, ?, 3)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $data['name'],
            $data['email'],
            $data['pwd'],
            $data['fname'],
            $data['lname'],
            
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;
    };
    

}

//recuperer tous les utilisateurs
function getAllUsers()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    return $data;
}

//recuperer un user avec son id
 //Todo: edit to prepare
function getUserById(int $id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $id);

    $data = mysqli_fetch_assoc($result);

    return $data;
}

//recuperer un user avec son nom dutilisateur
function getUserByUsername(string $name)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_name = '" . $name . "';";

    $result = mysqli_query($conn, $query);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);
    return $data;
}

//modifier un utilisateur
function updateUser(array $data,$name)
{
    global $conn;

        $query = "UPDATE user SET email = ?,pwd = ?,fname = ?,lname = ?,billing_address_id = ?,shipping_address_id = ? WHERE user_name=?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            
            mysqli_stmt_bind_param(
                $stmt,
                "ssssiis",
                $data['email'],
                $data['pwd'],
                $data['fname'],
                $data['lname'],
                $data['billing_address_id'],
                $data['shipping_address_id'],
                $name
            );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;

    }
}
require_once("../config/connexion.php");



// Function to update user addresses based on user ID
function updateUserAddresses($conn, $userID, $billingAddressID, $shippingAddressID) {
    // Update the user's billing address ID
    $updateBillingAddressID = mysqli_prepare($conn, "UPDATE user SET billing_address_id = ? WHERE user.id = ?");
    mysqli_stmt_bind_param($updateBillingAddressID, 'ii', $billingAddressID, $userID);
    mysqli_stmt_execute($updateBillingAddressID);

    // Update the user's shipping address ID
    $updateShippingAddressID = mysqli_prepare($conn, "UPDATE user SET shipping_address_id = ? WHERE user.id = ?");
    mysqli_stmt_bind_param($updateShippingAddressID, 'ii', $shippingAddressID, $userID);
    mysqli_stmt_execute($updateShippingAddressID);

    mysqli_stmt_close($updateBillingAddressID);
    mysqli_stmt_close($updateShippingAddressID);
}




//supprimer un utilisateur
function deleteUser( $name)
{
    global $conn;

    $query = "DELETE FROM user
                WHERE user.name= ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $name,
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;

    }
}
function updateUserToken($userId, $token) {
    global $conn;
    $sql = "UPDATE user SET token = '$token' WHERE id = $userId";
    mysqli_query($conn, $sql);

}