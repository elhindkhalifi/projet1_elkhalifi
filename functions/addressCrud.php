<?Php

function createAddress($data) {
    global $conn;
    $query="INSERT INTO address VALUES (NULL,?,?,?,?,?,?)";
    If( $stmt=mysqli_prepare($conn, $query)){
    /* Lecture des marqueurs */
    mysqli_stmt_bind_param($stmt,"sisss",$data['street_name'],$data['street_nb'],$data['city'],$data['province'],$data['zipcode'],$data['country']);
    /* Exécution de la requête*/
    $result= mysqli_stmt_execute($stmt);
    echo "<br> <br>";
    echo "<br> <br>";
    return $result;
        }
        };
        function getAddressById(int $id)
{   
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM address WHERE id = " . $id);

    $data = mysqli_fetch_assoc($result);
    

    return $data;
}



?>