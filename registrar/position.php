<?php
session_start();

if(!isset($_SESSION["username"]) AND $_SESSION["username"] == false){
header("location: ../../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Teacher Position Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#add-position">Add Position</button>

<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Teacher Position Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Position</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Position</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody><?php
include_once("initialize/config.php");

$query = "SELECT * FROM position";
$positions = mysqli_query($config,$query);
foreach ($positions as $position){
?>
<tr>
<td><?php echo $position["position"]; ?></td>
<td><time class="timeago" datetime="<?php echo $position["created"]; ?>" title="<?php echo $position["created"]; ?>"></time></td>
<td><a href="action-delete/delete-position.php?id=<?php echo $position["id"] ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-position.php?id=<?php echo $position["id"] ?>" class="btn btn-outline-primary">Edit</a></td>

</tr>

<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
<!-- Add Position -->
<div class="modal fade" id="add-position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Position</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="actions/add-position.php" method="POST" name="form-position" onsubmit="return positionvalidate()">
<div class="form-group">
<label for="position">Position</label>
<input type="text" name="position" id="position1" class="form-control">
</div>
<button type="submit" name="add" class="btn btn-primary">Save</button>
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
	function positionvalidate(){
		var position = document.forms["form-position"]["position1"].value;

		if (position == "") {
			alert("Position must be filled out!");
			return false;
		}
	}

	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
</body>

</html>
