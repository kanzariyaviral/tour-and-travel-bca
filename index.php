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

    


    <title>Alankar Tour</title>
</head>

<body>

    <head>
        <link rel="stylesheet" href="istyle.css">
    </head>

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



    <!--Image Slider-->
    <section>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="admin\img\slider_one.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="admin\img\slider_two.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="admin\img\slider_three.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section>
        <div class="container" id="cont">
            <div class="row">
                <?php
        $role = "SELECT * FROM `package`";
        $result = mysqli_query($conn ,$role);

        
        $res = mysqli_num_rows($result);
        if($res >0){
            while ($row = mysqli_fetch_assoc($result)) {
                $id=$row["pack_id"];
                $pack_name = $row["pack_name"];
                $pack_des = $row['pack_desc'];
                $pack_image = $row['pack_image'];
                $price = $row['pack_price'];
                ?>

                <div class="col-md-4">

                    <div class="card">
                        <div class="card-body">
                            <img src="admin/<?php echo $pack_image ?>" class="card-img-top" alt="" id="ig">
                            <h2 class="card-title" id="title"><?php echo $pack_name ?></h2>
                            <h4 class="card-title" id="h4"><?php echo $pack_des ?></h4>
                            <br>
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
                                                                $dicprice = $price-$perprice;
                                                                $whole = intval($dicprice);?>
                                                                <p id="wh">₹<?php echo $whole; ?></p>
                                                                <p id="pprice">₹<?php echo $packprice; ?></p>
                                                                <?php
                                                                
                                                            }
                                                            
                                                    ?>


                                                    <?php
                                                        }
                                                        else{?>
                                                        
                                                        <h3 class="card-title">₹<?php echo $price ?></h3>


                                                       <?php }
                                                    ?>
                            <?php echo"
                                        <a href='show_pack.php?packid=$id'>"; ?><br>
                            <button class="btn btn-sm btn-primary">Show More</button>
                            </a>
                        </div>
                    </div>
                </div>



                <?php
            }
        
        }
    }
            
            
        
    ?>
            </div>
        </div>
    </section>
    


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