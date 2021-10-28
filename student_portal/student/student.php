<?php
session_start();
include "initialize/config.php";
if(!isset($_SESSION["name"]) AND $_SESSION["name"] == false){
header("location: ../../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta.Martha Educational Center">
<title>Student Portal - <?php
echo htmlspecialchars($_SESSION["name"]);
?>  Student</title>
<link rel="icon" type="image/png" href="logo/logo.png">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="vendor/jquery/sweetalert.css"></script>
<script src="vendor/jquery/dataTables.bootstrap4.min.css"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery/sweetalert.min.js"></script>
<script src="vendor/jquery/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/sweetalert.min.js"></script>
</head>
<body id="page-top">


<?php include_once "header/nav.php"; ?>

<?php
include_once "initialize/config.php";

$check = "SELECT status FROM enrollies WHERE name='".$_SESSION["name"]."' LIMIT 1";
$check_run = mysqli_query($config,$check);

while($row = mysqli_fetch_array($check_run)){
$status = $row["status"];

if ($status == "Enrolled") {
echo "<div class='container'><div class='alert alert-success alert-dismissible fade show' role='alert'>
   <h5>Success you are now Enrolled in Sta. Martha Academy!</h5>
   <p>View your profile, just click your profile photo!</p>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";
}elseif($status == "Pending"){
echo "<div class='container'><div class='alert alert-info alert-dismissible fade show' role='alert'>
<h5>Please pay in the cashier for you to be Enroll!</h5>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";

}

}

?>

<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">LIST OF ENROLLED STUDENTS</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>

<tr>
<th>Student ID</th>
<th>Surname</th>
<th>Firstname</th>
<th>Course</th>
<th>Status</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Student ID</th>
<th>Surname</th>
<th>Firstname</th>
<th>Course</th>
<th>Status</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM enrollies";
$enrollies = mysqli_query($config,$query);
foreach ($enrollies as $enrollie){
?>
<tr>
<td><?php echo $enrollie["student_id"]; ?></td>
<td><?php echo $enrollie["surname"]; ?></td>
<td><?php echo $enrollie["firstname"]; ?></td>
<?php
$query  = mysqli_query($config,"SELECT * FROM course WHERE course_id = '".$enrollie["course"]."'");
while ($row = mysqli_fetch_assoc($query)) { ?>
<td><?php echo $row["course"]; ?></td>
<?php } ?>

<td><span class="badge badge-primary"><?php echo $enrollie["status"]; ?></span></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
<?php include "header/script.php"; ?>
</body>
</html>
