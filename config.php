<?php


function db() {
    $host = "127.0.0.1";
    $user = "root";
    $db = "zuriphp";
    $password = "";
    $conn = mysqli_connect($host, $user, $password, $db);
    if(!$conn){
        echo "<script> alert('Error connecting to the database') </script>";
    }
    // else{

    //     echo "connection was successful";
    // }
    return $conn;

}
