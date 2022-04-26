<?php
    include 'partials/_db.php';
    $delete_id = $_GET["pakid"];
    //echo $delete_id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql = "DELETE FROM `bus` WHERE `bus_id` = '$delete_id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        
        header('location: view_bus.php');
    }
    
?>