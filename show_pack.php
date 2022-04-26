<?php
    
    include 'partial/db.php';
    session_start();
    
?>
<!doctype html>
<html lang="en">

<head>

    <title>Alankar Tour</title>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="navstyle.css">


    <link rel="stylesheet" href="show_pack_style.css">



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
                                <img class="img-profile rounded-circle" src="admin/img/undraw_profile.svg" heigth="30px" width="30px">
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

    <!-- PHP for feedback form -->
    <?php
        $id = $_GET['packid'];

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $feedback = $_POST['feedback'];
                $rating = $_POST['rating'];
                $eeemail = $_SESSION['email'];
                $sql4 = "SELECT * FROM `user` WHERE `email` = '$eeemail'";
                $res4 = mysqli_query($conn, $sql4);
                while($row4 = mysqli_fetch_assoc($res4)){
                    $uuid = $row4['user_id'];
                
                $packkkid = $id;
                $sql5 = "INSERT INTO `feedback` (`feedback`, `package_pack_id`, `user_user_id`) VALUES('$feedback', '$packkkid', '$uuid')";
                $res5 = mysqli_query($conn, $sql5);
                if($res5){
                    $sql6 = "INSERT INTO `rating` (`rating`, `user_user_id`, `package_pack_id`) VALUES('$rating', '$uuid', '$packkkid')";
                    $res6 = mysqli_query($conn, $sql6);
                    if($res6){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Your Value-able Feedback saved..
                                <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                            </div>'; 
                    }
                }
            }

            }
    
        }
        else{
            if(isset($_POST['submit'])){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please Do Login First...
                <a href="login.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
              </div>'; 
            }
        }
    ?>

    <!-- Image  Slider   -->

    <?php

        $sql = "SELECT * FROM `package` WHERE `pack_id` = '$id'";
        $res = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($res)){
            $packname = $row['pack_name'];
            $img = $row['pack_image'];?>


    <div class="container-fluid">
        <div class="row" style="background-color: white; ">
            <div class="col-1"></div>
            <div class="col-10">
                <h1><?php echo $packname ?></h1>
                <div class="row">
                    <div class="col-11 me-0 pe-0 ms-0 ps-0" style="border: 2px solid black; height: 
                         400 px;">
                        <div id="carouselExampleSlidesOnly" class="carousel slide me-0 pe-0" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="admin/<?php echo $img ?>" class="d-block w-100" style="height: 368px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="admin/<?php echo $img ?>" class="d-block w-100" style="height: 368px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="admin/<?php echo $img ?>" class="d-block w-100" style="height: 368px;" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-4 ps-1">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"
                            style="border: 2px solid black">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="leh.jpg" class="d-block w-100" style="height: 180px;" alt="...">
                                </div>
                            </div>
                        </div> 
                        <div id="carouselExampleSlidesOnly" class="carousel slide mt-1" data-bs-ride="carousel"
                            style="border: 2px solid black">
                             <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="leh.jpg" class="d-block w-100" style="height: 180px;" alt="...">
                                </div>
                            </div> 
                        </div>
                    </div> -->
                </div>

            </div>
            <div class="col-1"></div>
        </div>
      
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8">
                                    <h3 id="sc">Schedule</h3>
                                    <?php
                                    // echo $id;
                                        $sql1 = "SELECT * FROM `schedule` WHERE `fk_pack_id` = '$id'";
                                        $res1 = mysqli_query($conn, $sql1);
                                        $j = 1;
                                        while($row1 = mysqli_fetch_assoc($res1)){
                                            $placename = $row1['place_name'];
                                            $des = $row1['des'];
                                            $trans = $row1['transport_mode'];
                                            $hotelid = $row1['fk_hotel_id'];
                                            $sql2 = "SELECT * FROM hotel WHERE `hotel_id` = '$hotelid'";
                                            $res2 = mysqli_query($conn, $sql2);
                                            while($row2 = mysqli_fetch_assoc($res2)){
                                                $hotelname = $row2['hotel_name'];
                                                $star = $row2['hotel_star'];
                                                ?>
                                                <h4>Day <?php echo $j; ?>:</h4>
                                                <h5><?php echo $placename; ?></h5> 
                                                <p><?php echo $des; ?></p>
                                                <p><?php echo $trans; ?></p>
                                                <p><?php echo "Hotel Name:  $hotelname"; ?></p>
                                                <?php if($star == '1'){ ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php }
                                                else if($star == '2'){ ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php }
                                                elseif($star == '3'){ ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php }
                                                else if($star == '4'){ ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php }
                                                else if($star == '5'){ ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                <?php }

                                                
                                                
                                            }
                                            $j = $j+1;
                                        }
                                    ?>
                                    <form action="" method="POST">
                                        <h2><br>Write Your Feedback </h2>
                                        <h5 id="rat1">Enter Your Rating</h5><input type="number" required max="5" min="1" name="rating" id="rating"><br>
                                        <textarea name="feedback" id="feedback" cols="60" required rows="7"placeholder="Write your feedback here."></textarea><br>
                                        <input type="submit" name="submit"value="Submit">
                                    </form>
                                    <?php
                                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ 
                                        
                                        ?>

                                        <h2><br>View Feedback And Rating</h2>
                                        <?php

                                            $sql7 = "SELECT * FROM `feedback` WHERE `package_pack_id` = '$id'";
                                            $res7 = mysqli_query($conn, $sql7);
                                            $sql8 = "SELECT * FROM `rating` WHERE `package_pack_id` = '$id'";
                                            $res8 = mysqli_query($conn, $sql8);
                                          
                                            
                                                

                                            while($row5 = mysqli_fetch_assoc($res7)){
                                                $feedbackkk = $row5['feedback'];
                                                $uuuid = $row5['user_user_id'];
                                                $sql9 = "SELECT * FROM `user` WHERE `user_id` = '$uuuid'";
                                                $res9 = mysqli_query($conn, $sql9);
                                                while($row7 = mysqli_fetch_assoc($res9)){
                                                    $uuname = $row7['user_name'];

                                                while($row6 = mysqli_fetch_assoc($res8)){
                                                    $ratt = $row6['rating'];
                                                    $pacid = $row6['package_pack_id'];

                                                
                                        if($id == $pacid){

                                        ?>
                                        <h5>User Name: <?php echo $uuname; ?></h5>
                                        <h5 id="rat2">Rating</h5>
                                        <?php if($ratt == '1'){ ?>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    <?php }
                                                    else if($ratt == '2'){ ?>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    <?php }
                                                    elseif($ratt == '3'){ ?>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    <?php }
                                                    else if($ratt == '4'){ ?>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                    <?php }
                                                    else if($ratt == '5'){ ?>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                    <?php }
                                                    ?><br>
                                        <textarea name="" id="" cols="50" rows="4" disabled><?php echo $feedbackkk; ?></textarea>
                                    <?php
                                }
                            }
                        }
                                
                                }

                                 } ?>
                                    </div>
                                    <div class="col-4">
                                        <div class="card" id="cad">
                                            <div class="card-body">
                                                <div class="card-1">
                                                    <?php $sql3 = "SELECT * FROM `package` WHERE `pack_id` = '$id'";
                                                    $res3 = mysqli_query($conn , $sql3);
                                                    while($row3 = mysqli_fetch_assoc($res3)){
                                                        $packprice = $row3['pack_price'];
                                                        
                                                        $sql10 = "SELECT * FROM `offer` WHERE `package_pack_id` = '$id'";
                                                        $res10 = mysqli_query($conn, $sql10);
                                                        $of = mysqli_num_rows($res10);
                                                        if($of == 1){
                                                            while($row8 = mysqli_fetch_assoc($res10)){
                                                                $per = $row8['discount'];
                                                                $ldate = $row8['offer_end_date'];
                                                                $cdate = date("y-m-d");
                                                                
                                                                $perprice = $packprice*$per/100;
                                                                $dicprice = $packprice-$perprice;
                                                                $whole = intval($dicprice);?>
                                                                <p id="wh">₹<?php echo $whole; ?></p>
                                                                <p id="pprice">₹<?php echo $packprice; ?></p>
                                                                <?php
                                                                
                                                            }
                                                            
                                                    ?>


                                                    <?php
                                                        }
                                                        else{?>
                                                        
                                                    <h5 id="perp">₹<?php echo $packprice; ?> </h5>

                                                       <?php }
                                                    ?>
                                                    
                                                    <p id="perk">Per Person</p>
                                                    
                                                    <?php } ?>
                                                </div>
                                                <div class="card-2">
                                                <?php echo"
                                                    <a href='passdetail.php?packid=$id'>"; ?>
                                                        <button class="btn btn-sm btn-primary">Proceed To Book Online</button>
                                                    </a>
                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-1 text-center">
                                        </a><br><br>
                    </div>
                    
            </div>
            <div class="col-1"></div>
        </div> 




    </div>

    <?php }
?>

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