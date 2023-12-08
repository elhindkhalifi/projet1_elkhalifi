<?php
$server="localhost";
$userName="root";
$pwd="";
$db="ecom1_project";

$conn=mysqli_connect($server, $userName, $pwd, $db);
if ($conn){
    echo"connected to the $db database successfully";
    global $conn;
}else{
    echo"error:not connected";
};?>