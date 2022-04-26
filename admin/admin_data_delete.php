<?php
    include 'C:\xampp\htdocs\tour\partial\db.php';
    session_start();
    
    $delete_id = $_GET["pakid"];
    //echo $delete_id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql = "DELETE FROM `user` WHERE `user_id` = '$delete_id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        
        header('location: admin_data.php');
    }
    



?>