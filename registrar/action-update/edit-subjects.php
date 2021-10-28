<?php
session_start();

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM subject WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $subject = $row["subject"];
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Manage Position</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<?php
if (isset($_POST["update1"])) {
	$id = $_POST["id"];
    $subject = $_POST["subject"];
    $date = date("Y-m-d H:i:s");


	$stmt = mysqli_query($config,"UPDATE subject SET subject = '".$subject."', created = '".$date."' WHERE id = '".$id."'" );
	if ($stmt == true) {
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited An Subject')");
	echo ("<script>window.location.href='../subjects.php?success_edit=Data has been updated!'</script>");
	}else{
	echo ("<script>window.location.href='../subjects.php?error_edit=No operation has been occured!'</script>");
	}
}
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Manage Position (<?php echo $subject; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
			<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				  <div class="form-group">
		            <label for="exampleInputEmail1">Add Subject</label>
		             <select class="form-control" id="subject" name="subject">
		              <option value="<?php echo $subject; ?>" selected><?php echo $subject; ?></option>
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM subject");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["subject"];  ?>"><?php echo $row["id"];  ?>. <?php echo $row["subject"] ?></option>
		              <?php
		              }
		              ?>

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
