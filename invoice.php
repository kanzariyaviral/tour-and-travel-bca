<?php
    include 'partial/db.php';
    session_start ();
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="invoicestyle.css">

    <title>Alankar Tour</title>
</head>

<body>


    <!--NavBar-->

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin/admin_login.php">Alankar Tour</a>
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
                        <a class="nav-link" href="aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ContactUs</a>
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

                <?php }
                    }
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
    <?php 
    $sno = 0;
    $pp = 0;
        $email = $_SESSION['email'];
        $pid = $_GET['pack'];
        // echo $email;
        $sql = "SELECT * FROM `user` WHERE email='$email'";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res)){
            $uname = $row['user_name'];
            $ucontact = $row['contact_no'];
            $uid= $row['user_id'];
    ?>
    <div class="container">
        <div class="row"></div>
        <div class="col-12">
            <h1 class="text-center">Invoice</h1>
            <table>

                <tr>
                    <td>
                        <h4 id="h53">Company Name</h4>
                        <h5 id="h54">Alankar Tour & Travel</h5>
                        <p id="p54">Shop no.2, Swastik Society, <br>Near by new roop kala studio,<br> Nikol gam
                            road,<br> Ahmedabad - 382350, India</p>
                    </td>
                    <td><img src="/tour/admin/upload/logo.jpg" alt="" id="ig23"></td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                    <h4 id="h55">Bill To</h4>
                        <h5 id="h56"><?php echo $uname; ?> </h5>
                        <p id="p55"><?php echo $ucontact; ?> <br> <?php echo $email; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table id="t1">
                            <tr id="t2">
                                <td id="t3" rowspan="2">Sno</td>
                                <td id="t3" rowspan="2">Package Name</td>
                                <td id="t3" colspan="5">Passenger Details</td>
                                <td id="t3" rowspan="2">Price</td>
                            </tr>
                            <tr id="t2">
                                <td id="t3">Name</td>
                                <td id="t3">Dob</td>
                                <td id="t3">Gender</td>
                                <td id="t3">Contact</td>
                                <td id="t3">Email</td>
                            </tr>
                            <?php  
    
            $sql2 = "SELECT * FROM `pass_info` WHERE `fk_use_id` = '$uid' && `fk_package` = '$pid'";
            $res2 = mysqli_query($conn, $sql2);     
            while($row1 = mysqli_fetch_assoc($res2)){
                $sno = $sno +1;
                $pname = $row1['p_name'];
                $dob = $row1['bod'];
                $gender = $row1['gender'];
                $contact = $row1['mob'];
                $memail = $row1['email'];
                $pid = $row1['fk_package'];
                
                $sql3 = "SELECT * FROM package WHERE pack_id = '$pid'";
                $res3 = mysqli_query($conn, $sql3);
                while($row2 = mysqli_fetch_assoc($res3)){
                    $packname = $row2['pack_name'];
                    $price = $row2['pack_price'];
                    $pp = $pp + $price;
                }
            
        ?>

                            <tr id="t2">
                                <td id="t3"><?php echo $sno; ?></td>
                                <td id="t3"><?php echo $packname; ?> </td>
                                <td id="t3"><?php echo $pname; ?></td>
                                <td id="t3"><?php echo $dob; ?></td>
                                <td id="t3"><?php echo $gender; ?></td>
                                <td id="t3"><?php echo $contact; ?></td>
                                <td id="t3"><?php echo $memail; ?></td>
                                <td id="t3">₹<?php echo $price; ?></td>
                            </tr>

                            <?php  
                
                
            }

    }
    ?>
                            <tr id="t2">
                                <td id="t4" colspan="7">Total Price</td>
                                <td id="t5">₹<?php echo $pp; ?></td>
                            </tr>
                        </table>

                    </td>

                </tr>

            </table>

        </div>
    </div>









    <!--footer-->
    <?php
        include "footer.php";
    ?>

    <!--Toast Messages-->
    <section>

    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>