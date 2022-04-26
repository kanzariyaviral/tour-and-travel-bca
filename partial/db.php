<?php
    //connection
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "tour";

    //Create connection
    $conn = mysqli_connect($servername ,$user ,$password ,$database);
    
    //Die if connection not found
    if(!$conn){
        die("sorry we failed to connect: ".mysqli_error($conn));
    }
    
?>