<?php
session_start();

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM teachers WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $name = $row["name"];
       $email = $row["email"];
       $position = $row["position"];

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
<title>Dashboard - Manage Teacher</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<?php
if (isset($_POST["update1"])) {
	$id = $_POST["id"];
	$name = $_POST["name"];
    $email = $_POST["email"];
    $position = $_POST["position"];

	$stmt = mysqli_query($config,"UPDATE teachers SET name = '".$name."',  email = '".$email."', position = '".$position."' WHERE id= '".$id."'" );
	if ($stmt == true) {
	
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited An Teacher')");

	echo ("<script>window.location.href='../teacher.php?success_edit=Data has been updated!'</script>");
	}else{
	echo ("<script>window.location.href='../teacher.php?error_edit=No operation has been occured!'</script>");
	}
}
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Manage Teacher (<?php echo $name; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				      <input type="hidden" name="id" value="<?php echo $id; ?>">
				    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">

				    <small id='emailHelp' class='form-text text-muted'>Your current Name</small>
				  </div>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">

				    <small id='emailHelp' class='form-text text-muted'>Your current Email</small>
				  </div>

				 <div class="form-group">
				  <label for="inputState">Teacher Position</label>
				  <select id="inputState" class="form-control" name="position" required>
				            <option selected>Select Teacher's Position</option>

				    <?php
				    include_once "initialize/config.php";
				    $select = mysqli_query($config, "SELECT * FROM position");
				    while ($row = mysqli_fetch_assoc($select)) {
				        ?>
				        <option><?php echo $row["position"]; ?></option>
				      <?php } ?>
				  </select>
				</div>
				 <button type="submit" name="update1" class="btn btn-primary">Update</button>
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
