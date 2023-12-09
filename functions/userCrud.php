<?php

//creer un utilisateur
function createUser(array $data)
{
    global $conn;
    
    $query = "INSERT INTO user(id,user_name,email,pwd,fname,lname, role_id) VALUES (NULL, ?, ?, ?, ?, ?, 3)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $data['user_name'],
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
function getUserByUsername(string $user_name)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user.user_name = '" . $user_name . "';";

    $result = mysqli_query($conn, $query);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);
    return $data;
}

//modifier un utilisateur
function updateUser(array $data)
{
    global $conn;

        $query = "UPDATE user SET user_name = ?,email = ?,pwd = ?,fname = ?,lname = ?,billing_address_id = ?,shipping_address_id = ? WHERE user.id = ?;";

        if ($stmt = mysqli_prepare($conn, $query)) {
            
            mysqli_stmt_bind_param(
                $stmt,
                "ssssii",
                $data['email'],
                $data['pwd'],
                $data['fname'],
                $data['lname'],
                $data['billing_address_id'],
                $data['shipping_address_id'],
            );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}

//supprimer un utilisateur
function deleteUser(int $id)
{
    global $conn;

    $query = "DELETE FROM user
                WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id,
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}
function updateUserToken($userId, $token) {
    global $conn;
    $sql = "UPDATE user SET token = '$token' WHERE id = $userId";
    mysqli_query($conn, $sql);
}