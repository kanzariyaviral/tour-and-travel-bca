<?php
    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include "partial/db.php";
        
        $file = $_FILES['userimage'];
        $filename = str_replace(' ','',$file['name']);
        $filetmp = $file['tmp_name'];
        $destinationfile = 'admin/upload/'.$filename;


        $user_name = $_POST['username'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contact_no = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $name = "/^[a-zA-Z ]+$/";
        $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
        $number = "/^[0-9]+$/";
        // $strong = "/^[A-Z ]+(\.[_a-z0-9-]+)$/"
        if(empty($user_name) || empty($email) || empty($dob) || empty($password) || empty($cpassword) ||
	    empty($contact_no) || empty($gender) ){
		
            echo "
                <div class='alert alert-warning'>
                    <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a><b>PLease Fill all fields..!</b>
                </div>
            ";
            exit();
            } else {
            if(!preg_match($name,$user_name)){
            echo "
                <div class='alert alert-warning'>
                    <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                    <b>this $user_name is not valid..!</b>
                </div>
            ";
            exit();
            }
        
            if(!preg_match($emailValidation,$email)){
            echo "
                <div class='alert alert-warning'>
                    <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                    <b>this $email is not valid..!</b>
                </div>
            ";
            exit();
            }
            if(!empty($password) && ($password == $cpassword)) {
                if (strlen($password) <= '8') {
                    echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                        <b>Your Password Must Contain At Least 8 Characters!</b>
                    </div>
                ";
                exit();

                }
                elseif(!preg_match("#[0-9]+#",$password)) {
                    echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                        <b>Your Password Must Contain At Least 1 Number!</b>
                    </div>
                ";
                    exit();
                }
                elseif(!preg_match("#[A-Z]+#",$password)) {
                    echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                        <b>Your Password Must Contain At Least 1 Capital Letter!</b>
                    </div>
                ";
                    exit();
                }
                elseif(!preg_match("#[a-z]+#",$password)) {
                    echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                        <b>Password contain atleast 8 character</b>
                    </div>
                ";
                                    exit();
                } elseif(!$password == $cpassword) {
                    echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                        <b>Password and Confirm Password not same</b>
                    </div>
                ";
                                    exit();
                }
            }
            if(!preg_match($number,$contact_no)){
            echo "
                <div class='alert alert-warning'>
                    <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
                    <b>Mobile number $contact_no is not valid</b>
                </div>
            ";
            exit();
            }
                if(!(strlen($contact_no) == 10)){
                echo "
                    <div class='alert alert-warning'>
                        <a href='signup.php' class='btn-close' data-bs-dismiss='alert' aria-label='close'></a>
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

            $role = "SELECT * FROM `role` WHERE role_name = 'User'";
            $result = mysqli_query($conn ,$role);
            while ($row = mysqli_fetch_assoc($result)) {
                $result1 = $row["role_id"];
            }
            //$result1 = mysqli_fetch_assoc($result);

            if($numExistRows > 0){
                $showError = "Email Already Exists";
            }
            else{
                if($password == $cpassword){
                            $enpass=md5($password);
                            $sql = "INSERT INTO `user` (`user_name`, `email`, `user_image`, `password`, `dob`, `contact_no`, `gender` ,`role_role_id`) VALUES ('$user_name', '$email', '$destinationfile', '$enpass', '$dob', '$contact_no', '$gender' ,'$result1')";
                            $res = mysqli_query($conn ,$sql);
                            if($res){
                                move_uploaded_file($filetmp ,$destinationfile);
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
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="signupstyle.css">

    <title>SignUp</title>
</head>

<body>
    <?php 
        require "partial/nav.php";

        
        if($showAlert){
             
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created and you can login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
        }

        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
        }
    ?>

    <div class="container-fluid mt-4  ">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 whole-form">
                <form action="/tour/signup.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-14 align-center">

                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username">
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
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="form-group">
                        <label for="userimage">User Image</label>
                        <input type="file" accept="image/*" name="userimage" id="userimage" required class="form-control" style="height:44px">
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
            <div class="col-4"></div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>