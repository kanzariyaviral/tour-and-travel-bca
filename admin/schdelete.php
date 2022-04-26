<?php
include 'partials/_db.php';
    $id = $_GET['pakid'];
    // echo $id;

    // DELETE FROM `package` WHERE `package`.`pack_id` = $delete_id
    $sql = "DELETE FROM `schedule` WHERE `fk_pack_id` = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        
        header('location: view_package.php');
    }
?>
