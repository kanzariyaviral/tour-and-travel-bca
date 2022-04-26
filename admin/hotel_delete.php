<?php
    include 'partials/_db.php';
    $delete_id = $_GET["pakid"];
    //echo $delete_id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql1 = "DELETE FROM `room` WHERE `hotel_hotel_id` = '$delete_id'";
    $res1 = mysqli_query($conn, $sql1);
    
    if($res1){
        $sql = "DELETE FROM `hotel` WHERE `hotel_id` = '$delete_id'";
        $res = mysqli_query($conn, $sql);
        if($res){
        header('location: view_hotel.php');}
    }
    
?>