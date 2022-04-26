<?php
    $login = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include "partial/db.php";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $enpass=md5($password);
        // echo"$enpass";
        

        //$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$enpass'";
        $res = mysqli_query($conn ,$sql);
        $num = mysqli_num_rows($res);

       

        if($num == 1){
            while($row = mysqli_fetch_assoc($res)){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    header("location: index.php");
            }
        }
        else{
            $_SESSION['loggedin'] = false;
            $showError = "Invalid Credentials";
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

    <title>Hello, world!</title>
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
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
        }
    ?>
    <div class="container-fluid mt-4  ">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 whole-form">
                <h1>Login to our website.</h1>
                <form action="/tour/login.php" method="POST">
                    <div class="form-group col-md-14 align-center">

                        <label for="email" class="form-label">Email address</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group col-md-14">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    
                    <p>reset your password.<a href="resetpass.php">click Here</a><br>
                    forgot your password no worry?<a href="recover_email.php">Click Here</a></p>
                    
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