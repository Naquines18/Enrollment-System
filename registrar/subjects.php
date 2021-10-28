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
<title>Dashboard - Subjects Management</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#add-grade-level">Add Subjects</button>
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Subjects Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Subject ID</th>
<th>Subject</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Subject ID</th>
<th>Subject</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM subject";
$subjects = mysqli_query($config,$query);
foreach ($subjects as $subject){
?>
<tr>
<td><?php echo $subject["id"]; ?></td>
<td><?php echo $subject["subject"]; ?></td>
<td><?php echo $subject["created"]; ?></td>
<td><a href="action-delete/delete-subjects.php?id=<?php echo $subject["id"]; ?>" class="btn btn-outline-danger">Delete</a></th><th> <a href="action-update/edit-subjects.php?id=<?php echo $subject["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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
<!-- Add-grade-level-->

<?php
if (isset($_POST["add"])) {
	$sub = $_POST["subject"];
	$created = date("Y-m-d H:i:s");

  $insert = $config->prepare("INSERT INTO subject(subject,created) VALUES(?,?)");
  $insert->bind_param("ss",$sub,$created);
  $insert->execute();
  switch ($insert == true) {
    case true:

      create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Subject')");
   echo "<script>window.location.href='subjects.php'</script>";
   die();
      break;

    default:
   echo "<script>window.location.href='subjects.php'</script>";
   die();
      break;
  }
  $insert->close();
  $config->close();
}


?>
<div class="modal fade" id="add-grade-level" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="" method="POST" name="subject" onsubmit="return validate()">

<div class="form-group">
<label for="grade">Subject</label>
<input type="text" name="subject" id="subject" class="form-control">
</div>

<button type="submit" name="add" class="btn btn-primary">Save</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">

  function validate(){
    var subject = document.forms["subject"]["subject"].value;

    if (subject == "") {
      alert("Subject must be filled");
      return false;
    }
  }
	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
