<?php
session_start();
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}
include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $select = mysqli_query($config,"SELECT * FROM registered WHERE id=$id");
    $row = mysqli_fetch_assoc($select);
	$id = $row["id"];
	$name = $row["name"];
	$email = $row["email"];
   
}

    $profile_img = array('https://pickaface.net/gallery/avatar/Identical52046a933b5e3.png','https://pickaface.net/gallery/avatar/55373343_180307_1836_cojv.png','https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png','https://pickaface.net/gallery/avatar/.1967556f8245f14e5.png');
    $rand_profile = array_rand($profile_img);
    $profile = $profile_img[$rand_profile];
?>

<?php
if (isset($_POST["update1"])) {
	$id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $profile = $_POST["profile"];
    $password = $_POST["password"];
    $status = "Not Enroll";

	$stmt = mysqli_query($config,"UPDATE registered SET name = '".$name."', email = '".$email."', profile_image = '".$profile."', status = '".$status."' WHERE id = '".$id."'" );
	if ($stmt == true) {
	
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited An User')");

	echo ("<script>window.location.href='../user.php?success_edit=Data has been updated!'</script>");
	}else{
	echo ("<script>window.location.href='../user.php?error_edit=No operation has been occured!'</script>");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Update <?php echo $name; ?></title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold">Update user with the name of : (<?php echo $name; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="" method="POST">
				  <div class="form-group">
				  	<input type="hidden" name="id" value="<?php echo $id; ?>">
				    <label for="exampleInputEmail1">Fullname</label>
				    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
				    <small id="emailHelp" class="form-text text-muted">Your current Name</small>
				  </div>

				   <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
				    <small id="emailHelp" class="form-text text-muted">Your current Email Address</small>
				  </div>

				   <div class="form-group">
				    <input type="hidden" class="form-control" name="profile" value="<?php echo $profile; ?>" readonly>
				  </div>

				   <div class="form-group">
				    <label for="exampleInputEmail1">Enter New Password</label>
				    <input type="text" class="form-control" name="password" value="">
				    <small id="emailHelp" class="form-text text-muted">Update Password</small>
				  </div>
				  <button type="submit" class="btn btn-primary" name="update1">Update</button>
				</form>
		</div>
	</div>

</table>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#dataTable").DataTable();
    });
</script>
<?php include_once "header/footer.php"; ?>

</body>
</html>
