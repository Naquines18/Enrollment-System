<?php
session_start();
if (isset($_SESSION["STUDENT_ID"])) {
   header("location: student_portal/student/dashboard.php");
}

if(isset($_GET['code']) && isset($_GET['name']) && isset($_GET['message'])){

	require_once 'initialize/config.php';
	
	$status = "1";
	$name   = $_GET['name'];
	$message = $_GET['message'];

	$checkifverified = $config->prepare("SELECT verified FROM registered WHERE name = ? LIMIT 1");
	$checkifverified->bind_param("s",$name);
	$checkifverified->execute();
	$result = $checkifverified->get_result();

	if($result->num_rows == 1){
		$row = $result->fetch_assoc();

		if($row['verified'] == 1){
			header("location: login.php?message=You are already verified.");
		}else{
			$updateStatus = $config->prepare("UPDATE registered SET verified = ? WHERE name = ? LIMIT 1 ");
			$updateStatus->bind_param("ss",$status,$name);
			
			if($updateStatus->execute()){
				header("location: login.php?message=".$message."");
			}else{
				header("location: login.php?message=You have an error in SQL Query");
			}
		}
	}


	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcfb_lWose6RJrf0a99-Juted9ylJnfOwybnlZekH9-m5Q-m3uBAKgDrGiOKZoeJDyVQR7Ty19cF3JZRvi5lxS-BQtLJKhYqha0Q&usqp=CAU&ec=45732301">
	<meta name="description" content="Enrollment System for Sta.Martha Educational Center">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="assests/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">

	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('three.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form action="actions/login.php" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-59">
						Sign In As Student
					</span>

					<?php
					if (isset($_GET["message"])) {
						echo "
						<div class='alert alert-warning alert-dismissible fade show' role='alert'>
						  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						    <span aria-hidden='true'>&times;</span>
						  </button>

						  <p>
						  ".$_GET["message"]."
					  </p>
					  
						</div>";
					}
					?>

					<?php
					if (isset($_GET["error"])) {
						echo "
						<div class='alert alert-warning alert-dismissible fade show' role='alert'>
						  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						    <span aria-hidden='true'>&times;</span>
						  </button>

						  <p>
						  ".$_GET["error"]."
					  </p>
					  
						</div>";
					}
					?>

					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<span class="label-input100">Full Name</span>
						<input class="input100" type="text" name="name" placeholder="Fullname...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button name="login" class="login100-form-btn">
								Sign In
							</button>
						</div>

						<a href="index.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign Up
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
					&nbsp
					<div class="container-login100-form-btn">
						<a href="registrar/index.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
						<u>	Sign In as registrar </u>
						</a>

						<a href="./forgot.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
						<u>	Forgot Password </u>
						</a>

						<a href="admin/index.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
						<u>Sign In as Admin</u>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/select2/select2.min.js"></script>
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>
