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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="Dropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        

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
                        <h1 class="h3 mb-0 text-gray-800">Add Driver</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
            

            if($_SERVER['REQUEST_METHOD']== 'POST'){
                
                
                $driver_name = $_POST['driver_name'];
                $email = $_POST['email'];
                $contact_no = $_POST['contact_no'];
                $dob = $_POST['dob'];
                $name = "/^[a-zA-Z ]+$/";
                $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
                $number = "/^[0-9]+$/";

                if(empty($driver_name) || empty($dob) || empty($email) || empty($contact_no)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='add_driver.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
                    </div>
                ";
                exit();
                } else {
                if(!preg_match($name,$driver_name)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='add_driver.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>this driver name $driver_name is not valid..!</b>
                    </div>
                ";
                exit();
                }
            
                if(!preg_match($emailValidation,$email)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='add_driver.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>this email $email is not valid..!</b>
                    </div>
                ";
                exit();
                }
                if(!preg_match($number,$contact_no)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='add_driver.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Mobile number $contact_no is not valid</b>
                    </div>
                ";
                exit();
                }
                if(!(strlen($contact_no) == 10)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='add_driver.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Mobile number must be 10 digit</b>
                    </div>
                ";
                exit();
                }}
                
                $sql = "INSERT INTO driver (`driver_name` ,`email` ,`contact_no` ,`dob`) VALUES ('$driver_name' ,'$email' ,'$contact_no' ,'$dob')";
                $res = mysqli_query($conn ,$sql);

                if($res){

                    echo '<div class="container">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Driver added sccessfuly.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            </div>
                        </div>'; 
                }
                else{
                    echo '
                            <div class="container-fluid">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> please enter valid details.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                            </div>';
                }
            }
        ?>

                        <!--Form-->
                        <div class="container">
                            <form action="add_driver.php" method="POST">
                                <div class="form-group">
                                    <label for="driver_name" class="form-label">Driver Name</label>
                                    <input type="text" class="form-control" required id="driver_name" name="driver_name"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" required id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="contact_no" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" required id="contact_no" name="contact_no">
                                </div>
                                <div class="form-group">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" style="width:200px;" class="form-control" required id="dob"
                                        name="dob">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Driver</button>
                            </form>



                            <!--PHP-->






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