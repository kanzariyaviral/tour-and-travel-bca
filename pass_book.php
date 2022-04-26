<?php
    include 'partial/db.php';
    session_start();
    $pemail = $_SESSION['email'];

    $id = $_GET['pack'];
    $membernoo = $_GET['memberid']; 

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
                $sql1 = "SELECT * FROM `user` WHERE `email` = '$pemail'";
                $res1 = mysqli_query($conn, $sql1);
                while($row = mysqli_fetch_assoc($res1)){
                    $userid = $row['user_id'];
                
                
                for($i=0;$i<$membernoo;$i++){
                    $username = $_POST["pusername$i"];
                    $dob = $_POST["pdob$i"];
                    $gender= $_POST["pgender$i"];
                    $mob = $_POST["pphone$i"];
                    $email = $_POST["pemail$i"];

                    // echo $username.'<br>';
                    // echo $dob.'<br>';
                    // echo $gender.'<br>';
                    // echo $mob.'<br>';
                    // echo $email.'<br>';
                    // // echo "click inside for  loop";
                    $sql = "INSERT INTO `pass_info` (`p_name`, `bod`, `gender`, `mob`, `email`, `fk_package`, `fk_use_id`) VALUES('$username', '$dob', '$gender', '$mob', '$email', '$id', '$userid')";
                    $res = mysqli_query($conn, $sql); }
                    if($res){
                        echo '
                        <div class="container-fluid">
                            <div class="alert alert-success alert-dismissible">
                                <strong>Success!</strong> Book successfully.
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                            </div> 
                        </div>';   
                        header('location: invoice.php?pack='.$id);                 }
                    else{
                        echo '
                        <div class="container-fluid">
                            <div class="alert alert-danger alert-dismissible">
                                <strong>Success!</strong> Error! While booking.
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                            </div> 
                        </div>';                    }
                
            }
        
            
            
        }
    }
    else{
        header ('location: login.php');
    }
    
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>