<?Php

// function createAddress($data) {
//     global $conn;
//     $query="INSERT INTO address VALUES (NULL,?,?,?,?,?,?)";
//     If( $stmt=mysqli_prepare($conn, $query)){
//     /* Lecture des marqueurs */
//     mysqli_stmt_bind_param($stmt,"sissss",$data['street_name'],$data['street_nb'],$data['city'],$data['province'],$data['zip_code'],$data['country']);
//     /* Exécution de la requête*/
//     $result= mysqli_stmt_execute($stmt);
//     echo "<br> <br>";
//     echo "<br> <br>";
//     return $result;
//         }
//      };
function createAddress($data) {
    global $conn;

    $query = "INSERT INTO address VALUES (NULL,?,?,?,?,?,?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sissss", $data['street_name'], $data['street_nb'], $data['city'], $data['province'], $data['zip_code'], $data['country']);
        mysqli_stmt_execute($stmt);

        // Get the last inserted ID
        $lastInsertedID = mysqli_insert_id($conn);

        mysqli_stmt_close($stmt);

        return $lastInsertedID;
    } else {
        return false;
    }
}

        function getAddressById(int $id)
{   
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM address WHERE id = " . $id);

    $data = mysqli_fetch_assoc($result);
    

    return $data;
}



?>