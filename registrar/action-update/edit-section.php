<?php
session_start();
include "../initialize/config.php";

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM sections WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $section = $row["section"];
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
<title>Dashboard - Manage Section</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<?php
if (isset($_POST["update1"])) {
	$id = $_POST["id"];
    $section = $_POST["section"];
    $date = date("Y-m-d H:i:s");


	$stmt = mysqli_query($config,"UPDATE sections SET section = '".$section."', created = '".$date."' WHERE id = '".$id."'" );
	if ($stmt == true) {

	create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Updated A Section')");

	echo ("<script>window.location.href='../section.php?success_edit=Data has been updated!'</script>");
	}else{
	echo ("<script>window.location.href='../section.php?error_edit=No operation has been occured!'</script>");
	}
}
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Manage Position (<?php echo $section; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
			<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Section</label>
				    <input type="text" class="form-control" name="section" value="<?php echo $section; ?>">

				    <small id='emailHelp' class='form-text text-muted'>Current Section</small>
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
