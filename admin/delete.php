<?php
    include 'C:\xampp\htdocs\tour\partial\db.php';
    session_start();
    
    $delete_id = $_GET["pakid"];
    //echo $delete_id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql = "DELETE FROM `package` WHERE `pack_id` = '$delete_id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        
        header('location: view_package.php');
    }
    


?>