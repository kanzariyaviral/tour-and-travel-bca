<?php
    include 'C:\xampp\htdocs\tour\partial\db.php';
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="busstyle.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
    include 'partials/_navbar.php';

?>



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">

                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>

                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Schedule</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    
                    <?php
                        if(isset($_POST['placesubmit'])){
                            $scheduleid = $_GET['schedule'];
                            $placepackid = $_GET['packid'];
                            // echo $scheduleid;
                            
                                for($i=0; $i<$scheduleid; $i++){
                                    $placename = $_POST["placename$i"];
                                    $placedes = $_POST["placedes$i"];
                                    $placetransp = $_POST["placetransp$i"];
                                    $placehotelname = $_POST["placehotelname$i"];
                                    $name = "/^[a-zA-Z ]+$/";
                                    if(empty($placename) || empty($placedes) || empty($placetransp) || empty($placehotelname) ){
                                        
                                        echo "
                                        <div class='container'>
                                            <div class='alert alert-warning'>
                                            <b>PLease Fill all fields..!</b><a href='schedule.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'>&times</a>
                                            </div>
                                        </div>
                                    ";
                                    }
                                    else{
                                        $sql1 = "INSERT INTO schedule (`place_name`, `des`, `transport_mode`, `fk_pack_id`, `fk_hotel_id`) VALUES ('$placename', '$placedes', '$placetransp', '$placepackid', '$placehotelname')";
                                        $res1 = mysqli_query($conn, $sql1);
                                        if($res1){
                                            echo '
                                            <div class="container-fluid">
                                                <div class="alert alert-success alert-dismissible">
                                                    <strong>Success!</strong> Schedule added successfully.
                                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                                                </div> 
                                            </div>';
                                        }
                                        else{
                                            echo '
                                            <div class="container-fluid">
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Error!</strong> please enter valid details.
                                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                                                </div>
                                            </div>';
                                        }
                                    }
                                 
                                }
                                    
                            
                            
                            
                            
                        }
                    ?>

                    <dic class="container">
                        <form action="" method="POST">
                            <hr>
                            <h5>Schedule</h5>
                            <hr>
                            <label for="schd" required>Please select Total number of schedule want to add</label>
                            <select name="Schd"  id="mno">
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
                            </select><br>
                            <label for="placepackno">Please Select Package Name</label>
                                <select name="placepackno" required>
                                    <option value="NULL">Select</option>
                                    <?php
                                    $sql = "SELECT * FROM `package`";
                                    $res = mysqli_query($conn ,$sql);
                                    while ($row = mysqli_fetch_array($res)){
                                        echo "<option value='$row[pack_id]'>$row[pack_name]</option>";
                                    } 
                                ?>
                                </select>
                            <input type="submit" value="submit" name="submit">
                        </form>
                    </dic>



                        <!--PHP-->
                        <div class="container">

                            <?php
                                if(isset($_POST['submit'])){ 
                                    $scheduleno = $_POST['Schd']; 
                                    $placepackno = $_POST['placepackno'];
                                    ?>
                                    <p>You have Selected <?php  echo $_POST['placepackno']; ?></p><?php 
                                    for($i=0; $i<$scheduleno; $i++){   
                                        echo "
                                                <form action='?schedule=$scheduleno&packid=$placepackno' method='POST'>"; ?>
                                                    <p>Schedule <?php echo $i+1 ?></p>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="placename">Place Name</label>
                                                        <input type="text" name="placename<?php echo $i; ?>" id="placename">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="placedes">Place Description</label>
                                                        <input type="text" name="placedes<?php echo $i; ?>" id="placedes">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="placetransp">Transport Mode</label>
                                                        <input type="text" name="placetransp<?php echo $i; ?>" id="placetransp">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="placehotelname" class="form-label">Hotel Name</label>
                                                        <select name="placehotelname<?php echo $i; ?>">
                                                            <option value="NULL">Select</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `hotel`";
                                                            $res = mysqli_query($conn ,$sql);
                                                            while ($row = mysqli_fetch_array($res)){
                                                                echo "<option value='$row[hotel_id]'>$row[hotel_name]</option>";
                                                            } 
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <?php } ?>
                                                    <!-- <button type="submit" class="btn btn-primary" name="sub2">Submit</button> -->
                                                    <input type="submit" name="placesubmit" id="placesubmit" value="Submit">
                                                </form>
                                            <?php   
                                    
                                }
                            ?>
                        </div>















                    </div>


                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                    crossorigin="anonymous"></script>

                <script src="https://code.jquery.com/jquery-3.6.0.js"
                    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

                <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
                </script>


                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

            </div>
            <!-- End of Page Wrapper -->
            <?php
                include 'partials/_footer.php';
                include 'partials/_script.php';
    ?>