<?php
    include 'partial/db.php';
    session_start();
    
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






    <title>Alankar holiday</title>
</head>

<body>

    <link rel="stylesheet" href="passdetail.css" />

    <!--NavBar-->

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_login.php">Alankar Tour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Packages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ContactUs</a>
                    </li>
                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>&nbsp;
                </form> -->
                <?php
                    

                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                        $sql = "SELECT * FROM user WHERE `email` = '$_SESSION[email]'";
                        $res = mysqli_query($conn ,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            $uname = $row['user_name'];
                        
                        ?>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="admin/img/undraw_profile.svg" heigth="30px"
                            width="30px">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $uname; ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="user_profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="my_booking.php">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Booking
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </div>

                <?php }}
                    else{?>
                <a href="/tour/login.php">
                    <button class="btn btn-outline-success" type="button" id="btn1">Login</button></a>&nbsp;&nbsp;
                <a href="/tour/signup.php">
                    <button class="btn btn-outline-success" type="button" id="btn1">Signup</button></a>
                <?php }
                ?>
            </div>
        </div>
    </nav>

    <!-- <?php 
        
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created and you can login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
          </div>';  
        }

        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
          </div>';  
        }
    ?> -->

    <div class="container  ">
        <form action="" method="POST">
            <td>
                <label for="member">Please select Total number of member want to travel</label>
                <select name="member" id="mno">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </td>


            <button type="submit" class="btn btn-primary" id="sbtn" name="submit">Submit</button>
        </form>
        <?php

            $id = $_GET['packid'];
            if(isset($_POST['submit'])){
                $memberno = $_POST['member'];
            echo "

        <form action='pass_book.php?pack=$id&memberid=$memberno' method='POST'>" ?>
        <?php 
            for ($i=0; $i<$memberno; $i++){ ?>
        <table>
            <p>Member <?php echo $i+1; ?></p>
            <tr>
                <td>
                    <p id="iiuser">Member Name</p>
                </td>
                <td>
                    <p id="pdob">Date of Birth</p>
                </td>
                <td>
                    <p id="gender">Gender</p>
                </td>
                <td>
                    <p id="mob">Mobile No</p>
                </td>
                <td>
                    <p id="email">Email address</p>
                </td>
            </tr>
            <tr>
                <td><input type="text" class="form-control" required name="pusername<?php echo $i ?>" id="iusername"></td>
                <td><input type="date" class="form-control" required name="pdob<?php echo $i ?>" id="dob"></td>
                <td><select required name="pgender<?php echo $i ?>" id="sgender">
                        <option value="none" selected>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">other</option>
                    </select></td>
                <td><input type="tel" required id="imob"  name="pphone<?php echo $i ?>" class="form-control"></td>
                <td><input type="email" required name="pemail<?php echo $i ?>" class="form-control" id="iemail"
                        aria-describedby="emailHelp">
                </td>
            </tr>
        </table>
        <?php }  

            $sql = "SELECT * FROM `package` WHERE `pack_id` = '$id'";
            $res = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($res)){
                $pack_name = $row['pack_name'];
                $pack_price = $row['pack_price'];
            
        ?><br>
        <table id="t156">

            <tr>
                <th id="t157">Package Name</th>
                <th id="t157">Package Price</th>
                <th id="t157">Number of Member</th>
                <th id="t157">Total Price</th>
            </tr>

            <tr>
                <td id="t158"><?php echo $pack_name; ?></td>
                <td id="t158">₹<?php echo $pack_price; ?></td>
                <td id="t158"><?php echo $memberno; ?> </td>
                <td id="t158">₹<?php echo $pack_price * $memberno; ?></td>
            </tr>

        </table><br>
        <?php }
            
            
        
        ?>
        <input type="submit" value="Book Now">


        <?php } ?>

        <!-- 
                    
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['booknow'])){
                echo "click";

                    if(isset($_POST['submit'])){
                    $memberno = $_POST['member']; 
                        for($i=0;$i<$memberno;$i++){
                            $username = $_POST['username'];
                            $dob = $_POST['dob'];
                            $gender= $_POST['gender'];
                            $mob = $_POST['phone'];
                            $email = $_POST['email'];

                            echo $username;
                            echo $dob;
                            echo $gender;
                            echo $mob;
                            echo $email;
                            echo "click";
                        }
                    }
                }
            }    
        
                    
                        
                     -->
        </form>
        <?php
            
        ?>
    </div>
    </div>
    </div>

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