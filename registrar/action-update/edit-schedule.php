<?php
session_start();
include "../initialize/config.php";

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

if (isset($_GET["schedule_id"])) {
    $id = $_GET["schedule_id"];

   $select = mysqli_query($config,"SELECT * FROM schedule WHERE schedule_id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $sched = $row["schedule"];

   }
}

if(isset($_POST["update"])){
$id = $_POST["id"];

$sched = $_POST["sched"];

$update = $config->prepare("UPDATE schedule SET schedule = ?  WHERE schedule_id = ?");

$update->bind_param("si",$sched,$id);
$update->execute();

if($update == TRUE){
create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited A Schedule')");
header("location: ../schedules.php");
}else{
header("location: edit_schedule.php?error");
}

$update->close();
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
<title>Dashboard - Adminpanel</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Update Schedule (<?php echo $sched; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Day</label>
				      <input type="hidden" name="id" value="<?php echo $id; ?>">
				    <input type="text" class="form-control" name="sched" value="<?php echo $sched; ?>">
            

				    <small id='sched' class='form-text text-muted'>Your current Schedule</small>
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


<script type="text/javascript">
    $(document).ready(function(){
        $("#dataTable").DataTable();
    });
</script>
