<?php
session_start();
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}
include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM schoolyear WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $schoolyear = $row["schoolyear"];
       $created = $row["created"];
   }
}
$error = "";
if (isset($_POST["update"])) {
	$id = $_POST["id"];
	$date = date("Y-m-d H:i:s");
	if (empty($_POST["year"])) {
		echo "<script language='javascript'>Input fields are required</script>";
	}else{
		$year = $_POST["year"];
	}

	$stmt = mysqli_query($config,"UPDATE schoolyear SET schoolyear = '".$year."',  created = '".$date."' WHERE id= '".$id."'" );
	if ($stmt == true) {

		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited An School Year')");

	header("location: ../year.php?success_edit=Data has been updated!");
	}else{
	header("location: ../year.php?error_edit=No operation has been occured!");
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
<title>Dashboard - Update <?php echo $schoolyear; ?></title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Update School-Year (<?php echo $schoolyear; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">School Year</label>
				      <input type="hidden" name="id" value="<?php echo $id; ?>">
				    <input type="text" class="form-control" name="year" value="<?php echo $schoolyear; ?>">

				    <small id='emailHelp' class='form-text text-muted'>Your current School Year</small>
				  </div>
				  <button type="submit" name="update" class="btn btn-primary">Update</button>
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
