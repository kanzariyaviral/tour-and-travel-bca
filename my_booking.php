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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <title>Hello, world!</title>
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

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Booking</h1>

        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Pack_id</th>
                            <th scope="col">pack_name</th>
                            <th scope="col">Pack_desc</th>
                            <th scope="col">Pack_image</th>
                            <th scope="col">Pack_Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                            $email = $_SESSION['email'];
                            $sql1 = "SELECT * FROM `user` WHERE `email` = '$email'";
                            $res1 = mysqli_query($conn, $sql1);
                            while($row1 = mysqli_fetch_assoc($res1)){
                                $uid= $row1['user_id'];
                            }
                        $sql = "SELECT * FROM `pass_info` WHERE `fk_use_id` = '$uid'";
                        $res = mysqli_query($conn ,$sql);
                        $sno = 0;
                        while($row = mysqli_fetch_assoc($res)){

                            $pid = $row['fk_package']; 
                            
                            $sql2 = "SELECT * FROM `package` WHERE `pack_id` = '$pid'";
                            $res2 = mysqli_query($conn, $sql2);
                            while($row2 = mysqli_fetch_assoc($res2)){
                                $sql3 = "SELECT * FROM `pass_info` WHERE `fk_use_id` IN (
                                    SELECT `fk_use_id`
                                    FROM `pass_info`
                                    GROUP BY `fk_use_id`
                                    HAVING COUNT(distinct `fk_package`) > 1
                                )";
                                $res3 = mysqli
                                $pimage = $row2['pack_image'];
                            
                            $sno = $sno + 1;
                            $img = "admin/$pimage";
                            // $id = $row['pack_id'];
                            echo "<tr>
                                       <th scope='row'>". $sno ."</th>
                                        <td>". $row2['pack_name'] ."</td>
                                        <td>". $row2['pack_desc'] ."</td>
                                        <td>". $row2['pack_price']."</td>
                                        <td><img src=". $img." height='100px' width='100px'></td>
                                        
                                                
                                    </tr>";
                                        
                            }
                                }
                            }
                                   ?>


                    </tbody>
                </table>
            </div>







        </div>



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
        <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        </script>
</body>

</html>