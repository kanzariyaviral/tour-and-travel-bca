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
                        <h1 class="h3 mb-0 text-gray-800">Edit Train</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
        
                $ID = $_GET['packid'];
               
                $sql = "SELECT * FROM `train` WHERE `train_id`='$ID' ";
                $res = mysqli_query($conn ,$sql);
                foreach($res as $row){?>
                        <div class="container">
                            <form action="" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $row['train_id']?>">

                                <div class="form-group">
                                    <label for="trainno_edit" class="form-label">Train No</label>
                                    <input type="text" class="form-control" value="<?php echo $row['train_no'] ?>" id="trainno_edit" name="trainno_edit">
                                </div>



                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Arrival Time</th>
                                            <th class="text-center">Departure Time</th>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control" style="width:180px;" value="<?php echo $row['date'] ?>"
                                                    id="date_edit" name="date_edit"></td>
                                            <td><input type="time" class="form-control" style="width:180px;" value="<?php echo $row['arrival_time'] ?>"
                                                    id="arrivaltime_edit" name="arrivaltime_edit"></td>
                                            <td><input type="time" class="form-control" style="width:180px;" value="<?php echo $row['departure_time'] ?>"
                                                    id="departuretime_edit" name="departuretime_edit"></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="destination_edit" class="form-label">Destination</label>
                                    <input type="text" class="form-control" value="<?php echo $row['destination'] ?>" id="destination_edit"
                                        name="destination_edit">
                                </div>
                                <?php
                                    $sql1 = "SELECT * FROM `train_has_train_category` WHERE `train_train_id` = '$ID'";
                                    $res1 = mysqli_query($conn ,$sql1);
                                    while($row1 = mysqli_fetch_assoc($res1)){
                                        $seatno = $row1['seat_no'];
                                        $coachno = $row1['train_coach_no'];
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="seatno_edit" class="form-label">Seat No</label>
                                    <input type="tel" class="form-control" value="<?php echo $seatno ?>" id="seatno_edit" name="seatno_edit">
                                </div>

                                <div class="form-group">
                                    <label for="coachno_edit" class="form-label">Coach No</label>
                                    <input type="tel" class="form-control" value="<?php echo $coachno ?>" id="coachno_edit" name="coachno_edit">
                                </div>

                                <div class="form-group">
                                    <label for="traintype" class="form-label">Train Type</label>
                                    <select name="type_edit">
                                        <option value="">Select</option>
                                        <option value="A/C">A/C</option>
                                        <option value="Non A/C">Non A/C</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="traincoachtype" class="form-label">Train Coach Type</label>
                                    <select name="traincoachtype_edit">
                                        <option value="">Select</option>
                                        <?php
                                            $sql = "SELECT * FROM `train_coach_category`";
                                            $res = mysqli_query($conn ,$sql);
                                            while ($row = mysqli_fetch_array($res)){
                                                echo "<option value='$row[train_coach_category_no]'>$row[train_coach_type]</option>";
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                            </form>
                            <?php }
                if(isset($_POST['update_btn'])){
                    //echo "Done";
                    $edit_id = $_POST['edit_id'];
                      

                    $trainno = $_POST['trainno_edit'];
                    $seat_no = $_POST['seatno_edit'];
                    $destination = $_POST['destination_edit'];
                    $date = $_POST['date_edit'];
                    $arrival_time = $_POST['arrivaltime_edit'];
                    $departure_time = $_POST['departuretime_edit'];
                    $coach_no = $_POST['coachno_edit'];
                    $traintype = $_POST['type_edit'];
                    $traincattype = $_POST['traincoachtype_edit'];
                    
                    $sql = "UPDATE `train` SET `train_no` = '$trainno', `train_type` = '$traintype', `date` = '$date', `arrival_time` = '$arrival_time', `departure_time` = '$departure_time', `destination` = '$destination'  WHERE `train_id` = '$edit_id' ";
                    $res = mysqli_query($conn ,$sql);
    
                    if($res){
                        $sql2 = "UPDATE `train_has_train_category` SET `seat_no` = '$seat_no', `train_coach_category_train_coach_category_no` = '$traincattype', `train_coach_no` = '$coach_no' WHERE `train_train_id` = '$edit_id'";
                        $res2 = mysqli_query($conn ,$sql2);
                        if($res2){

                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> Your data updated!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';}
                        }
                        else{
                            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> their is an error to update your data!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                    }
                    
                
            

            
        ?>



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