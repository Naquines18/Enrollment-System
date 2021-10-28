<?php
session_start();
include "../initialize/config.php";
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

if (isset($_GET["course_id"])) {
    $id = $_GET["course_id"];

   $select = mysqli_query($config,"SELECT * FROM course WHERE course_id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $course_id = $row["course_id"];
       $course = $row["course"];
       $created = $row["created"];
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
<title>Dashboard - Adminpanel</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<?php
if (isset($_POST["update"])) {
	$id = $_POST["course_id"];
	$date = date("Y-m-d H:i:s");
		$course = $_POST["course"];

	$stmt = mysqli_query($config,"UPDATE course SET course = '".$course."',  created = '".$date."' WHERE course_id= '".$id."'" );
	if ($stmt == true) {

		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited A Course')");


	echo ("<script>window.location.href='../subject-sched.php?success_edit=Data has been updated!'</script>");
	}else{
	echo ("<script>window.location.href='../subject-sched.php?error_edit=No operation has been occured!'</script>");
	}
}
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Update Course (<?php echo $course; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Course</label>
				      <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
				    <input type="text" class="form-control" name="course" value="<?php echo $course; ?>">

				    <small id='emailHelp' class='form-text text-muted'>Your current Course</small>
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
