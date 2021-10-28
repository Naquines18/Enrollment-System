<?php
session_start();
if (isset($_SESSION["STUDENT_ID"])) {
   header("location: student_portal/student/dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Forgot Password Page</title>
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
				<?php
					if(isset($_GET['code']) && isset($_GET['email']) && !empty($_GET['code']) && !empty($_GET['email']) ){
						echo '
						<form action="actions/changepassword.php" method="POST" class="login100-form validate-form" id="reset_password">
							<span class="login100-form-title text-center p-b-59">
								Create New Password
							</span>
		
							<input class="input100" type="hidden" name="email" value="'.$_GET['email'].'">

							<div class="wrap-input100 validate-input" data-validate = "Enter New Password">
								<span class="label-input100">New Password</span>
								<input class="input100" type="password" name="new_password" id="new_password" placeholder="*************">
								<span class="focus-input100"></span>
							</div>

							<div class="wrap-input100 validate-input" data-validate = "Enter Confirm Password">
								<span class="label-input100">Confirm Password</span>
								<input class="input100" type="password" name="confirm_password" id="confirm_password" placeholder="*************">
								<span class="focus-input100"></span>
							</div>
		
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button type="submit" name="reset" class="login100-form-btn">
								Send Forgot Password Link
								</button>
							</div>
		
						</form>
						';
					}else{
						echo '
						<form action="actions/forgot.php" method="POST" class="login100-form validate-form">
							<span class="login100-form-title text-center p-b-59">
								Forgot Password?
							</span>
		
							
							<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
								<span class="label-input100">Enter your email address</span>
								<input class="input100" type="text" name="email" placeholder="Email addess...">
								<span class="focus-input100"></span>
							</div>
		
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button type="submit" name="reset" class="login100-form-btn">
								Change Password
								</button>
							</div>
		
						</form>
						';
					}
				?>
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
	<script>
		
		const reset_password   = document.getElementById("reset_password");

		reset_password.addEventListener('submit', function(event){
			event.preventDefault();

			const new_password     = document.getElementById("new_password").value;
			const confirm_password = document.getElementById("confirm_password").value;

			if(new_password.trim() < 5 ){
				alert("Password must be 5 above characters.")
				return false;
			}
			
			if(confirm_password.trim() < 5 ){
				alert("Confirm Password must be 5 above characters.")
				return false;
			}

			if(new_password != confirm_password){
				alert("Please enter same password")
				return false;
			}else{
				reset_password.submit();
			}

		});	
	</script>
</body>
</html>
