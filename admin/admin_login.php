<?php
    require 'partials/_db.php';
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

    <title>Admin Login</title>
</head>

<body>
    <div class="container my-5">
    <form method="POST">  
        <h2 class="text-center">!!Admin Form</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Admin Email Id</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <p>reset your password.<a href="resetpass.php">click Here</a><br>
                    forgot your password no worry?<a href="recover_email.php">Click Here</a></p><br>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    </div>

    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            require 'partials/_db.php';
            $email = $_POST['email'];
            $password = $_POST['password'];
            $enpass=md5($password);
            // echo "$enpass";
            $sql =  "SELECT * FROM user WHERE email = '$email' AND password = '$enpass' AND `role_role_id` = '2'";
            $res = mysqli_query($conn ,$sql);
            $num = mysqli_num_rows($res);


            if($num == 1){
                while($row = mysqli_fetch_assoc($res)){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['admin_name'] = $_POST['name'];
                header("location: dashboard.php");
                }
            }
            else{
                echo "incorrect";
            }
        }
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>