<?php
    include 'partials/_db.php';
    $delete_id = $_GET["pakid"];
    //echo $delete_id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql1 = "DELETE FROM `flight_category_has_flight` WHERE `flight_flight_id` = '$delete_id'";
    $res1 = mysqli_query($conn, $sql1);
    
    if($res1){
        $sql = "DELETE FROM `flight` WHERE `flight_id` = '$delete_id'";
        $res = mysqli_query($conn, $sql);
        if($res){
        header('location: view_flight.php');}
    }
    
?>