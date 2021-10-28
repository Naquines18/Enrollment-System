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
<meta name="description" content="Enrollment System for Sta.Martha Educational Center">
<title>Dashboard - Data Management</title>

<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
	<?php
	if (isset($_GET["error"])) {
	echo '<div class="alert alert-success alert-dismissible">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h5>'.$_GET["error"].'</h5>
	</div>';
	}
	?>
</div>
<!-- End of Topbar -->

<!-- Content Row -->
<div class="container-fluid row">


<div class="col-md-6 mb-4">
<div class="card border-left-primary shadow py-2">
<div class="card-body">
<div class="row align-items-center">
<div class="col">
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
<i class="fas fa-check-circle"></i>
Total Enrollies</div>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM enrollies WHERE status='Enrolled'";
$students = mysqli_query($config,$query);
$student = mysqli_num_rows($students);
?>
<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $student; ?></div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-6 mb-4">
<div class="card border-left-success shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
<i class="fas fa-check-circle"></i>
Total Teachers</div>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM teachers";
$teachers = mysqli_query($config,$query);
$teacher = mysqli_num_rows($teachers);
?>
<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $teacher; ?></div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-6 mb-4">
<div class="card border-left-info shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
<i class="fas fa-check-circle"></i>
Expected Enrollees
</div>
<div class="row no-gutters align-items-center">
<div class="col-auto">
<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">100%</div>
</div>
<div class="col">
<div class="progress progress-sm mr-2">
<div class="progress-bar bg-info" role="progressbar"
style="width: 100%" aria-valuenow="100" aria-valuemin="0"
aria-valuemax="100"></div>
</div>
</div>
</div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-6 mb-4">
<div class="card border-left-warning shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
<i class="fas fa-user-times"></i>
Pending User's Status</div>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM enrollies WHERE status='Pending'";
$not = mysqli_query($config,$query);
$num = mysqli_num_rows($not);
?>
<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num; ?></div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>


<div class="col-md-12">
<div class="card shadow mb-4 mt-3">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">Security System Logs</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered" id="systemLogs" width="100%" cellspacing="0">
		<thead>
		<tr class="text-center">
				<th>No.</th>
				<th>Username</th>
				<th>Password Used</th>
				<th>Attempt</th>
				<th>Date Logged In</th>
		</tr>
		</thead>
		<tfoot>
			<tr class="text-center">
				<th>No.</th>
				<th>Username</th>
				<th>Password Used</th>
				<th>Attempt</th>
				<th>Date Logged In</th>
			</tr>
		</tfoot>
		<tbody>
		<?php
		$i = 1;
		$query = "SELECT * FROM audit_tbl";
		$audits = mysqli_query($config,$query);
		foreach ($audits as $audit){
		?>
		<tr class="text-center">
			<td><?php echo $i++ ?></td>
			<td><span class="badge badge-primary"><?php echo htmlentities($audit['username']); ?></span></td>
			<td><?php echo htmlentities($audit['hash_password']); ?></td>
			<td><span class="badge badge-info"><?php echo htmlentities($audit['loggedin_attemp']); ?></span></td>
			<td><?php echo htmlentities($audit['date_loggedin']); ?></td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
	  </div>
	  </div>
	</div>

	</div>
</div>
</div>








<script type="text/javascript">
	$(document).ready(function(){
		$("#dataTable").DataTable();
		$("#systemLogs").DataTable();
	});
</script>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Are you sure you want to logout?</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
<a class="btn btn-primary" href="logout.php">Yes</a>
</div>
</div>
</div>
</div>
<?php include_once "header/script.php"; ?>

</body>
</html>
