<?php
session_start();
if (isset($_SESSION["STUDENT_ID"])) {
   header("location: student_portal/student/dashboard.php");
}


if(!isset($_GET['email']) && !isset($_GET['name']) && !isset($_GET['message'])){
	header("location: index.php");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Verification Page</title>
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
				<form method="POST" class="login100-form">
					<span class="login100-form-title text-center p-b-59">
						Verify Account
					</span>

					<div class="alert alert-success">
						<p class="text-center"><?php echo htmlspecialchars($_GET['message']); ?></p>
					</div>

					<div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <a href="actions/resend_mail.php?email=<?php echo $_GET['email']; ?>&&name=<?php echo $_GET['name']; ?>" name="enroll" class="login100-form-btn">
						Re-send Link
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
