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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
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
                        <a class="dropdown-item" href="" >
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
                <h1 class="h3 mb-0 text-gray-800">Package</h1>
                
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
                        <th scope="col" >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM `package`";
                        $res = mysqli_query($conn ,$sql);
                        $sno = 0;
                        while($row = mysqli_fetch_assoc($res)){
                            $sno = $sno + 1;
                            $img = $row['pack_image']; 
                            $pack_image = "admin/$img";
                            $id = $row['pack_id'];
                            echo "<tr>
                                       <th scope='row'>". $sno ."</th>
                                        <td>". $row['pack_name'] ."</td>
                                        <td>". $row['pack_desc'] ."</td>
                                        <td>". $row['pack_price']."</td>
                                        <td><img src=". $img." height='100px' width='100px'></td>
                                        <td>
                                                <a href='edit.php?packid=$id'>
                                                    <button style='height: 25px; margine-top:0px; padding-top:0px' name='edit_btn' class='edit btn btn-sm btn-primary' id='edit_btn' >Edit</button>
                                                    </a>
                                                <a href='#'>
                                                <button style='height: 25px; margine-top:0px; padding-top:0px' class='delete btn btn-sm btn-primary' id='delete' data-bs-toggle='modal' data-bs-target='#exampleModal$id'>Delete</button></a>
                                                <br>
                                                <a href='#'>
                                                <button style='height: 25px; margine-top:0px; padding-top:0px' class='schdelete btn btn-sm btn-primary' id='schdelete' data-bs-toggle='modal' data-bs-target='#exampleModalschdelete$id'>schdelete</button></a>

                                                <!-- Modal -->
                                                <div class='modal fade' id='exampleModal$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 style='color:black; font-weight: bold;' class='modal-title' id='exampleModalLabel'>Warning</h5>
                                                                <button type='button' style='color:red;' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>x</button>
                                                            </div>
                                                            <div class='modal-body'>
                                
                                                                <h4 style='color: black;'>Are you sure!! to delete package</h4>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                
                                                                <a href='delete.php?pakid=$id'>
                                                                    <button type='button' name='delete' class='btn btn-primary' >Yes</button>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <!-- Modal -->
                                                <div class='modal fade' id='exampleModalschdelete$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 style='color:black; font-weight: bold;' class='modal-title' id='exampleModalLabel'>Warning</h5>
                                                                <button type='button' style='color:red;' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>x</button>
                                                            </div>
                                                            <div class='modal-body'>
                                
                                                                <h4 style='color: black;'>Are you sure!! to delete Schedule package</h4>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                                
                                                                <a href='schdelete.php?pakid=$id'>
                                                                    <button type='button' name='schdelete' class='btn btn-primary' >Yes</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                                
                                    </tr>";
                                        
                                   }?>
                                   
                                
                            </tbody>
                        </table>
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
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
  
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script

    </div>
    <!-- End of Page Wrapper -->
    <?php
                include 'partials/_footer.php';
                include 'partials/_script.php';
    ?>