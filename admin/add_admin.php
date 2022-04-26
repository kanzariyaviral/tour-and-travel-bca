<?php
    
    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include "partials/_db.php";
        
        $file = $_FILES['adminimage'];
        $filename = str_replace(' ','',$file['name']);
        $filetmp = $file['tmp_name'];
        $destinationfile = 'upload/'.$filename;


        $admin_name = $_POST['adminname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contact_no = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $name = "/^[a-zA-Z ]+$/";
        $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
        $number = "/^[0-9]+$/";
        if(empty($admin_name) || empty($email) || empty($dob) || empty($gender) || empty($contact_no) || empty($password) || empty($cpassword) ){
		
		echo "
			<div class='alert alert-warning'>
				<a href='add_admin.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	    } else {
		if(!preg_match($name,$admin_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='add_admin.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $admin-email is not valid..!</b>
			</div>
		";
		exit();
	    }
	
	    if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='add_admin.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	    }
        if(!empty($password) && ($password == $cpassword)) {
            if (strlen($password) <= '8') {
                echo "Your Password Must Contain At Least 8 Characters!";
            exit();

            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                echo "Your Password Must Contain At Least 1 Number!";
                exit();
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                echo "Your Password Must Contain At Least 1 Capital Letter!";
                exit();
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                echo "Your Password Must Contain At Least 1 Lowercase Letter!";
                exit();
            } elseif(!$password == $cpassword) {
                echo "Please Check You've Entered Or Confirmed Your Password!";
                exit();
            }
        }
	    if(!preg_match($number,$contact_no)){
		echo "
			<div class='alert alert-warning'>
				<a href='add_admin.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $contact_no is not valid</b>
			</div>
		";
		exit();
	    }
            if(!(strlen($contact_no) == 10)){
            echo "
                <div class='alert alert-warning'>
                    <a href='add_admin.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Mobile number must be 10 digit</b>
                </div>
            ";
            exit();
	    }}


        $allowed_extension = array('gif' ,'jpg' ,'jpeg' ,'png');
        $file_extension = pathinfo($filename ,PATHINFO_EXTENSION);
        if(!in_array($file_extension ,$allowed_extension)){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }   
        else{

            //check wheather username exists
            $existsql = "SELECT * FROM `user` WHERE email = '$email'";
            $res = mysqli_query($conn ,$existsql);
            $numExistRows = mysqli_num_rows($res);

            $role = "SELECT * FROM `role` WHERE role_name = 'Admin'";
            $result = mysqli_query($conn ,$role);
            while ($row = mysqli_fetch_assoc($result)) {
                $result1 = $row["role_id"];
            }
            //$result1 = mysqli_fetch_assoc($result);

            if($numExistRows > 0){
                $showError = "Admin email Already Exists";
            }
            else{
                if($password == $cpassword){
                    $enpass=md5($password); // Encrypted Password
                            $sql = "INSERT INTO `user` (`user_name`, `email`, `user_image`, `password`, `dob`, `contact_no`, `gender` ,`role_role_id`) VALUES ('$admin_name', '$email', '$destinationfile', '$enpass', '$dob', '$contact_no', '$gender' ,'$result1')";
                            $res = mysqli_query($conn ,$sql);
                            if($res){
                                move_uploaded_file($filetmp , $destinationfile);
                                $showAlert = true;
                            }
                            else{
                                $showAlert = "Password Do not match";
                            }
                        }
                    }
                    
                    
                
            }
        }
    
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

                    <!-- Topbar  -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item -  Dropdown (Visible Only XS) -->
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

                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Admin
                                </span>
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
                        <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php 
                            if($showAlert){
                                echo '
                                    <div class="container-fluid">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> Your account is now created and you can login.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                        </div>
                                    </div>';  
                            }

                            if($showError){
                                echo '
                                    <div class="container-fluid">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error!</strong> '. $showError.'.
                                            <button type="button"  style="align-item: right;" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                        </div>
                                    </div>';  
                            }
                        ?>

                        <div class="col-3"></div>
                        <div class="col-6 whole-form">
                            <form action="add_admin.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group col-md-14 align-center">

                                    <label for="adminname" class="form-label">Admin Name</label>
                                    <input type="text" class="form-control" name="adminname" id="adminname">
                                </div>
                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>Gender</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="date" class="form-control" name="dob" id="dob">
                                            </td>
                                            <td>
                                                <select name="gender">
                                                    <option value="none" selected>Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">other</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group col-md-14  align-center">

                                    <label for="phone">Mobile No</label><br>
                                    <input type="tel" id="phone" name="phone" class="form-control">

                                </div>
                                <div class="form-group col-md-14 align-center">

                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adminimage">Admin Image</label>
                                    <input type="file" accept="image/*" name="adminimage" id="adminimage" required
                                        class="form-control" style="height:44px">
                                </div>
                                <div class="form-group col-md-14">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group col-md-14">
                                    <label for="cpassword" class="form-label">Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                                </div><br>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="col-3"></div>

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