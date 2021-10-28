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
?>  View Grades</title>
<?php include "header/link-cdn.php"; ?>
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
<h6 class="m-0 font-weight-bold text-primary">Grades</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="98%" cellspacing="0">
<thead>

<tr>
<th>Subject</th>
<th>Final Grade</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Subject</th>
<th>Final Grade</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM grades WHERE student_name='".$_SESSION["name"]."'";
$grades = mysqli_query($config,$query);
foreach ($grades as $grade){
?>
<tr>

<?php
$query = "SELECT * FROM course WHERE course_id='".$grade["course"]."'";
$course = mysqli_query($config,$query);
while ($course1 = mysqli_fetch_assoc($course)) {
?>

<?php } ?>
<?php
$query = "SELECT * FROM subject WHERE id='".$grade["subject"]."'";
$course = mysqli_query($config,$query);
while ($sub = mysqli_fetch_assoc($course)) {
?>
<td><?php echo $sub["subject"]; ?></td>
<?php } ?>

<td><?php echo $grade["final_grade"]; ?></td>
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
