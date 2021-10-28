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
<title>Dashboard - Users Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#add-user">Add User</button>
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">User Registered Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Profile Image</th>
<th>Password</th>
<th>Status</th>
<th>Delete User</th>
<th>Edit User</th>

</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>Email</th>
<th>Profile Image</th>
<th>Password</th>
<th>Status</th>
<th>Delete User</th>
<th>Edit User</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM registered";
$users = mysqli_query($config,$query);
foreach ($users as $user){
?>
<tr>
<td><?php echo $user["name"];?></td>
<td><?php echo $user["email"];?></td>
<td><img class="img-profile rounded-circle" src="<?php echo $user["profile_image"]; ?>" width="50" height="50"></td>
<td><?php echo $user["password"]; ?></td>
<td><?php echo $user["status"];?></td>
<td><a href="action-delete/delete-user.php?id=<?php echo $user["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-user.php?id=<?php echo $user["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="alert alert-info">
<p class="text-muted" style="padding-bottom: 0px;">Your Profile photo and Cover photo is already provided by the system by default!</p>
</div>
<form action="actions/add-user.php" method="POST" name="user-form" onsubmit="return validateform()">

<div class="form-group">
<label for="name">Fullname</label>
<input type="text" name="name" id="name" class="form-control">
</div>

<div class="form-group">
<label for="email">Email address</label>
<input type="email" name="email" id="email" class="form-control">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1">
</div>

<button type="submit" name="add" class="btn btn-primary">Add User</button>
</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">

	function validateform(){
		var name = document.forms["user-form"]["name"].value;
		var email = document.forms["user-form"]["email"].value;
		var password = document.forms["user-form"]["password"].value;


		if (name == "") {
			alert("Student name must be filled out!");
			return false;
		}else if(email == ""){
			alert("Email must be filled out!");
			return false;
		}else if(password == ""){
			alert("Password must be filled out!");
			return false;
		}

	}

	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
