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
                        <h1 class="h3 mb-0 text-gray-800">Add Package</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
            

            if(isset($_POST['sub2'])){
                //$image = $_FILES['packimage']['name'];
                //$file = addslashes(file_get_contents($_FILES['packimage']['tmp_name']));
                $file = $_FILES['packimage'];
                $filename = str_replace(' ','',$file['name']);

                $filetmp = $file['tmp_name'];
                $name = $_POST['package'];
                $des = $_POST['des'];
                $price = $_POST['price'];
                $destinationfile = 'upload/'.$filename;
                $trainno = $_POST['trainno'];
                $flightno = $_POST['flightno'];
                $busno = $_POST['busno'];
                $hotelname = $_POST['hotelname'];
                $number = "/^[0-9]+$/";

                

                if(!preg_match($number,$price)){
                    echo "
                        <div class='alert alert-warning'>
                            <a href='package.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <b>invalide price</b>
                        </div>
                    ";
                    exit();
                }

                
                $allowed_extension = array('gif' ,'jpg' ,'jpeg' ,'png');
                $filename = $_FILES['packimage']['name'];
                $file_extension = pathinfo($filename ,PATHINFO_EXTENSION);
                if(!in_array($file_extension ,$allowed_extension)){
                    echo '
                            <div class="conatiner-fluid">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> Your image extension not valid.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                                </div>
                            </div>';
                }    
                else{
                    $sql = "INSERT INTO package (`pack_name` , `pack_desc` ,`pack_image` ,`pack_price`, `train_train_id`, `flight_flight_id`, `bus_bus_id`, `fk_hotel_id`) VALUES ('$name' ,'$des' ,'$destinationfile' ,'$price', '$trainno', '$flightno', '$busno', '$hotelname')";
                    $res = mysqli_query($conn ,$sql);

                    
                   

                    if($res){
                        //image upload to the database
                        //move_uploaded_file($_FILES['packimage']['name'], "upload/".$_FILES['packimage']['name']);
                        move_uploaded_file($filetmp , $destinationfile);

                        echo '
                                <div class="container-fluid">
                                    <div class="alert alert-success alert-dismissible">
                                        <strong>Success!</strong> Package added successfully.
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
            
        ?>

                        <!--Form-->
                        <div class="container">
                            <form action="package.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="packimage">Pakage Image</label>
                                    <input type="file" accept="image/*" name="packimage" id="packimage" required
                                        class="form-control" style="height:44px">
                                </div>
                                <div class="form-group">
                                    <label for="package" class="form-label">Package Name</label>
                                    <input type="text" class="form-control" required id="package" name="package"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="des" class="form-label">Package Description</label>
                                    <input type="text" class="form-control" required id="des" name="des">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Package Price</label>
                                    <input type="text" class="form-control" required id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="trainno" class="form-label">Train No</label>
                                    <select name="trainno">
                                        <option value="NULL">Select</option>
                                        <?php
                        $sql = "SELECT * FROM `train`";
                        $res = mysqli_query($conn ,$sql);
                        while ($row = mysqli_fetch_array($res)){
                            echo "<option value='$row[train_id]'>$row[train_no]</option>";
                        } 
                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="flightno" class="form-label">Flight No</label>
                                    <select name="flightno">
                                        <option value="NULL">Select</option>
                                        <?php
                        $sql = "SELECT * FROM `flight`";
                        $res = mysqli_query($conn ,$sql);
                        while ($row = mysqli_fetch_array($res)){
                            echo "<option value='$row[flight_id]'>$row[flight_no]</option>";
                        } 
                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="busno" class="form-label">Bus No</label>
                                    <select name="busno">
                                        <option value="NULL">Select</option>
                                        <?php
                        $sql = "SELECT * FROM `bus`";
                        $res = mysqli_query($conn ,$sql);
                        while ($row = mysqli_fetch_array($res)){
                            echo "<option value='$row[bus_id]'>$row[bus_no]</option>";
                        } 
                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hotelname" class="form-label">Hotel Name</label>
                                    <select name="hotelname">
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

                                <input type="submit" value="Submit" name="sub2">

                            </form>






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
                        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
                    </script>

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