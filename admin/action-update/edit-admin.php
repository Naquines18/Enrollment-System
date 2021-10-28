<?php
session_start();

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM admin WHERE id=$id LIMIT 1");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $username = $row["username"];
       $email = $row["email"];
   }
}else{
	header("location: ../admin.php");
}

 $profile_img = array('https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/117796916/original/63535411336d226c2a23e0caea4c8e2337fc6cae/draw-a-cute-and-nice-avatar-or-portrait-for-you.png','https://pickaface.net/gallery/avatar/20141124_020633_4603_Nice.png','https://pickaface.net/gallery/avatar/unr_niceguy_180217_2320_7idsqs59.png');
    $rand_profile = array_rand($profile_img);
    $profile = $profile_img[$rand_profile];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = mysqli_real_escape_string($config,$_POST["username"]);
    $email = mysqli_real_escape_string($config,$_POST["email"]);
    $profile = mysqli_real_escape_string($config,$_POST["profile"]);
    $newpass = mysqli_real_escape_string($config,$_POST["newpass"]);
    $newpass = sha1($_POST["newpass"]);
    $stmt = $config->prepare("UPDATE `admin` SET `username`= ? ,`email` = ?,`profile_pic`= ? ,`password`= ? WHERE id = ?");
    $stmt->bind_param("ssssi",
        $username,
        $email,
        $profile,
        $newpass,
        $id
    );
    $stmt->execute();
    if($stmt == true){
      create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited A Admin')");

      header("location: ../admin.php?success= Data Updated Successfully");
      exit();
    }else{
      header("location: ../admin.php?error");
    }
    $stmt->close();
    $config->close();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Update <?php echo $username; ?></title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold">Update Administrator with the username of : (<?php echo $username; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Username</label>
				    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
				    <small id="emailHelp" class="form-text text-muted">Your current Username</small>
				  </div>

				   <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
				    <small id="emailHelp" class="form-text text-muted">Your current Email Address</small>
				  </div>

				   <div class="form-group">
				    <label for="exampleInputEmail1">Your Profile Image</label>
				    <input type="text" name="profile" class="form-control" value="<?php echo $profile; ?>" readonly>
				    <small id="emailHelp" class="form-text text-muted text-warning">Your Profile Photo is provided by the system</small>
				  </div>

				   <div class="form-group">
				    <label for="exampleInputEmail1">Enter New Password</label>
				    <input type="text" name="newpass" class="form-control" value="">
				    <small id="emailHelp" class="form-text text-muted">Update Password</small>
				  </div>
				  <button type="submit" class="btn btn-primary">Update</button>
				</form>
		</div>
	</div>

</table>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#dataTable").DataTable();
    });
</script>
<?php include_once "header/footer.php"; ?>
