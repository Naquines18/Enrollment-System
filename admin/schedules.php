<?php
session_start();
if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Schedule Management</title>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<?php
if (isset($_GET["success"])) {
	echo '
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  '.$_GET["success"].'
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	';
}elseif(isset($_GET["fail"])){
	echo '
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  '.$_GET["fail"].'
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	';
}
?>

<div class="container-fluid">
<button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#add-sched">Add Schedules</button>
<!-- End of Topbar -->

<!-- DataTales Example --> <!-- DAY -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Schedules Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Schedule ID</th>
<th>Day</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Schedule ID</th>
<th>Day</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM schedule";
$schedules = mysqli_query($config,$query);
foreach ($schedules as $schedule){
?>
<tr>
<td><?php echo $schedule["schedule_id"]; ?></td>
<td><?php echo $schedule["schedule"]; ?></td>
<td><time class="timeago" datetime="<?php echo $schedule["created"]; ?>" title="<?php echo $schedule["created"]; ?>"></time></td>
<td>
<a href="action-delete/delete-schedule.php?schedule_id=<?php echo $schedule["schedule_id"]; ?>" class="btn btn-outline-danger">Delete</a>
</td>
<td><a href="action-update/edit-schedule.php?schedule_id=<?php echo $schedule["schedule_id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="add-sched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Schedules</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="schedule" id="insert" onsubmit="return validate()">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Day</label>
		    <input type="text" name="sched" class="form-control">
				<label for="exampleInputEmail1">Time</label>
		    <input type="text" name="oras" class="form-control">
		    <small id="manage" class="form-text text-muted">Manage schedules</small>
		  </div>
		  <button type="submit" id="submit" class="btn btn-primary">Save</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of DAY -->
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#add-time">Add Time</button>
<!-- DataTales Example TIME-->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Time Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Time ID</th>
<th>Time</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
	<th>Time ID</th>
	<th>Time</th>
	<th>Created</th>
	<th>Delete</th>
	<th>Edit</th>
</tr>
</tfoot>

<tbody>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM oras";
$orass = mysqli_query($config,$query);
foreach ($orass as $oras){
?>
<tr>
<td><?php echo $oras["id"]; ?></td>
<td><?php echo $oras["oras"]; ?></td>
<td><time><?php echo $oras["created"]; ?></time></td>
<td><a href="action-delete/delete-time.php?id=<?php echo $oras["id"] ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-time.php?id=<?php echo $oras["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
</tr>
<?php } ?>
</tbody>

</table>
</div>
</div>
</div>
</div>

<!-- Modal -->

	<div class="modal fade" id="add-time" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Add Time</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	</div>
	<div class="modal-body">
	<form action="actions/add-time.php" method="POST" name="oras" onsubmit="return validateform()">
	<div class="form-group">
	<label for="position">Time</label>
	<input type="text" name="oras" id="oras" class="form-control">
	</div>
	<button type="submit" name="add" class="btn btn-primary">Create</button>
	</form>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</div>
	</div>
	</div>
	</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
	$(document).ready(function(){
		//datatables
		$("#dataTable").DataTable();
		//ajax

		$("#insert").on("submit",function(e){
			$.ajax({
				url: "actions/add-schedule.php",
				method: "POST",
				data:$(this).serialize(),
				success:function(data){
					console.log(data);
					swal({
						  title: "Done!",
						  text: "Successfully data added!",
						  icon: "success",
						  button: "Exit!",
						});
				},
				error:function(data){
				swal("Oops...", "Something went wrong :(", "error");
			    }
			});
			e.preventDefault();
		});

	});
</script>

<script type="text/javascript">

  function validateform(){
    var oras = document.forms["oras"]["oras"].value;

    if (oras == "") {
      alert("Time must be filled out!");
      return false;
    }
  }

  $(document).ready(function(){
    $("#dataTable").DataTable();
  });
</script>
<?php include_once "header/footer.php"; ?>
