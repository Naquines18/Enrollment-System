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
<title>Dashboard - Section Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<button class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#add-section">Add Section</button>
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Section Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Section</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</thead>
<tfoot>
<tr>
<th>Section</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody>
<?php include_once("initialize/config.php");
$query = "SELECT * FROM sections";
$sections = mysqli_query($config,$query);
foreach ($sections as $section){
?>
<tr>
<td><?php echo $section["section"]; ?></td>
<td><?php echo $section["created"]; ?></td>
<td><a href="action-delete/delete-section.php?id=<?php echo $section["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<th> <a href="action-update/edit-section.php?id=<?php echo $section["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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
<!-- Modal -->
<div class="modal fade" id="add-section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="actions/add-section.php" method="POST" name="submit-form" onsubmit="return validateform()">

<div class="form-group">
<label for="section">Section</label>
<input type="text" name="section" id="section" class="form-control">
</div>

<button type="submit" name="add" class="btn btn-primary">Add Section</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	//validate form
	function validateform(){
		var section = document.forms["submit-form"]["section"].value;

		if (section == "") {
			alert("Section must be filled out!");
			return false;
		}
	}
	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
