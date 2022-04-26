<?php
    include 'partial/db.php';
    session_start();
?>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
	   <!--NavBar-->

	   <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Alankar Tour</a>
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
                        <a class="nav-link" href="#">About</a>
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
                                
                    <?php }}
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
<!DOCTYPE html>
<html>
<head>
	<title>About Us Section</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="aboutus.css">
</head>	
<body>
	<div class="section">
		<div class="container">
			<div class="content-section">
				<div class="title">
					<h1>About Us</h1>
				</div>
				<div class="content">

					<p>ALANKAR TOURS AND TRAVEL is an experienced travel management company to manage all elements of your travel in an efficient, cost effective and ethical manner. ABC Travel is committed to making a difference by being a one stop solution for all travel needs whether on business or on holiday. We are committed to providing a professional service to our customers, ensuring they benefit from our experience, unique style and energy. A highly visible, independent and progressive travel agency, we aim to make a difference in everything we do.</p>
					
				</div>
				<div class="social">
					<a href="https://www.facebook.com/AlankarHolidays/"><i class="fab fa-facebook-f"></i></a>
					<a href="https://mail.google.com/mail/u/0/#inbox?compose=DmwnWrRpdlxNnrWJXKgDxpCQMmbfLSjGmnkrmSRDTHWhwQjgRRzttVLNvwrtZfqZFCTCnTjSwvPl"><i class="fa fa-envelope"></i></a>
					<a href="https://www.google.com/maps/place/Alankar+Holidays/@23.038281,72.6380014,15z/data=!A!1m2!2m1!1salankar+holidays,+Swastik+Society+Cross+Road,+Swastik+Society,+Navrangpura,+Ahmedabad,+Gujarat!3m5!1s0x395e87150c1da9ff:0x987ff0d3eb1c3b2a!8m2!3d23.038281!4d72.6467561!15sCl5hbGFua2FyIGhvbGlkYXlzLCBTd2FzdGlrIFNvY2lldHkgQ3Jvc3MgUm9hZCwgU3dhc3RpayBTb2NpZXR5LCBOYXZyYW5ncHVyYSwgQWhtZWRhYmFkLCBHdWphcmF0kgENdG91cl9vcGVyYXRvcg"><i class="fa fa-map-marker"></i></a>
				</div>
			</div>
			<div class="image-section">
				<img src="./admin/img/img one.png">
			</div>
		</div>
	</div>

	  <!--footer-->
	  <?php
        include "footer.php";
    ?>
</body>
</html>