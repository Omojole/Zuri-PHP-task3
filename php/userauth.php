<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    $conn = db();
if(mysqli_num_rows(mysqli_query($conn,"SELECT email from students WHERE email='$email'"))>=1){
    header("location:../forms/login.html");
    echo "<script> alert('User already exists')</script>";
}
else{
$sql="INSERT INTO students(full_names,country,email,gender,`password`) VALUES ('$fullnames','$country','$email','$gender','$password')";

if(mysqli_query($conn,$sql)){
    header("location:../dashboard.php");
session_start();
$_SESSION['username']=$email;
    echo "<script> alert('User succesfully registered')</script>";
}
}
}


//login users
function loginUser($email, $password){
    $conn = db();

    $query="SELECT * FROM students WHERE email='$email' AND password='$password'";
$result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>=1){
session_start();
$_SESSION['username']=$email;
header('location:../dashboard.php');
    }
    else{
        header ('location:../forms/login.html');
    }
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    //open connection to the database and check if username exist in the database
    $query=" SELECT email FROM students WHERE email='$email'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>=1){
        $sql="UPDATE students set password='$password' where email='$email'";
        if(mysqli_query($conn,$sql)){
            echo 'Password changed sucessfully';
        }
        else{
            echo 'an error occured,try again';
        }
    }
    else{
        echo 'error occured';
    };
    //if it does, replace the password with $password given
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students WHERE id=$id"))>=1){
        $sql="DELETE FROM students WHERE id='$id'";
        if(mysqli_query($conn,$sql)){
            echo "deleted <br>";

        }
     }
     //delete user with the given id from the database

 }
