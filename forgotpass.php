<?php
    $login = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include "partial/db.php";
        $email = $_GET['mail'];
        // echo"$email";

        // $oldpassword = $_POST['oldpassword'];
        $password=$_POST['password'];
        $cpassword = $_POST['cpassword'];
        // $enpass=md5($oldpassword);
        // echo"$enpass";
        

        //$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        // $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$enpass'";
        // $res = mysqli_query($conn ,$sql);
        // $num = mysqli_num_rows($res);

       

        if(empty($password) || empty($cpassword)){
            // <div class='alert alert-warning'>
            //     <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a><b>PLease Fill all fields..!</b>
            // </div>
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>error</strong>PLease Fill all fields..!
            <a href="forgotpass.php">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>'; 
        
        exit();
        }
    
        else{
           
                // echo"hellow word";
            
                if(!empty($password) && ($password == $cpassword)) {
                            if (strlen($password) <= '8') {
                                echo "Your Password Must Contain At Least 8 Characters!";
                            exit();

                            }
                            elseif(!preg_match("#[0-9]+#",$password)) {
                                echo "Your Password Must Contain At Least 1 Number!";
                                exit();
                            }
                            elseif(!preg_match("#[A-Z]+#",$password)) {
                                echo "Your Password Must Contain At Least 1 Capital Letter!";
                                exit();
                            }
                            elseif(!preg_match("#[a-z]+#",$password)) {
                                echo "Your Password Must Contain At Least 1 Lowercase Letter!";
                                exit();
                            } elseif(!$password == $cpassword) {
                                echo "Please Check You've Entered Or Confirmed Your Password!";
                                exit();
                            }
                            // elseif($oldpassword==$password){
                            //     echo "your old password and new password is same please enter different password";
                            //     exit();
                            // }
                    }
                    
                if($cpassword ==$password){
                    // echo"hello11";
                   
                        // $sql1 = "SELECT * FROM `user` WHERE email = '$email'";
                        // $res1 = mysqli_query($conn ,$sql1);
                        // while($row=mysqli_fetch_assoc($res1)){
                        //     $user=$row['user_id'];

                        //     $sql2 = "SELECT * FROM user WHERE `user_id`='$user'";
                        //     $res2 = mysqli_query($conn ,$sql2);
                        //     $num2 = mysqli_num_rows($res2);
                        //     if($num2==1){


                            $enpass2=md5($password);
                            // echo"$email";
                            $sql3 = "UPDATE `user` SET password ='$enpass2' WHERE email='$email'";
                            $res3 = mysqli_query($conn ,$sql3);
                            if($res3){
                                        $showError=true;
                                    }
                            
                        }
                        // $numExistRows = mysqli_num_rows($res);
             
            
            else{
                            $showError = "Invalid Credentials";
                        }
            }
            }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>forgot password</title>
</head>

<body>
    <?php
        require "partial/nav.php";
        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
        }
       

        if($showError){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong>your password reset successfully
                                <a href="login.php">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
                              </div>'; 
                            }
    ?>
    <div class="container-fluid mt-4  ">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 whole-form">
                <h4>Please Enter New password</h4>
                <form action="" method="POST"> 
                    <div class="form-group col-md-14">
                        <label for="password" class="form-label">New password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group col-md-14">
                        <label for="cpassword" class="form-label">confirm password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>