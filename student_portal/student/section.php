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
?>  Section</title>
<?php include "header/link-cdn.php"; ?>
<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
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
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">SECTION</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Section</th>
<th>Created</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Section</th>
<th>Created</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM sections";
$sections = mysqli_query($config,$query);
foreach ($sections as $section){
?>
<tr>
<td><?php echo $section["section"]; ?></td>
<td><time class="timeago" datetime="<?php echo $section["created"]; ?>" title="<?php echo $section["created"]; ?>"></time></td>
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
  jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
</script>
<?php include_once "header/footer.php"; ?>
<?php include "header/script.php"; ?>
</body>
</html>
