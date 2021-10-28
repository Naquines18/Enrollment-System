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
<meta name="description" content="">
<meta name="author" content="">
<title>Dashboard - Admin Management</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">

<?php
if (isset($_GET["success"])) {
  echo"
      <div class='alert alert-success'>
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <h5>".$_GET["success"]."</h5>
      </div>
      ";
}

?>

<button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#add-admin">Add Administrator</button>
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Administrator</h6>
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
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>Email</th>
<th>Profile Image</th>
<th>Password</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM admin";
$admins = mysqli_query($config,$query);
foreach ($admins as $admin){
?>
<tr>
<td><?php echo $admin["username"]; ?></td>
<td><?php echo $admin["email"]; ?></td>
<td><img class="img-profile rounded-circle" width="50" height="50" src="<?php echo $admin["profile_pic"]; ?>"></td>
<td><?php echo $admin["password"]; ?></td>
<td><a href="action-delete/delete-admin.php?id=<?php echo $admin["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-admin.php?id=<?php echo $admin["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
</tr>

<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$images = array('https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/117796916/original/63535411336d226c2a23e0caea4c8e2337fc6cae/draw-a-cute-and-nice-avatar-or-portrait-for-you.png','https://www.w3schools.com/w3images/avatar6.png','https://www.google.com/url?sa=i&url=https%3A%2F%2Fpickaface.net%2Favatar%2F5998%2Fnice%2Bguy.html&psig=AOvVaw1RcPQ7v07pzHzEX8UydKIG&ust=1607914764938000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCODYm7f7ye0CFQAAAAAdAAAAABAI');

$rand = array_rand($images);
?>
<!--============= Add ADMIN ==========-->
<div class="modal fade" id="add-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="actions/add-admin.php" name="submit-data" method="POST" onsubmit="return validateform()">
<div class="form-group">
<label for="username">Username</label>
<input type="text" name="username" id="user" class="form-control">
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="text" name="email" id="email" class="form-control">
</div>

<div class="form-group">
<input type="hidden" name="profile" class="form-control" value="<?php echo $images[$rand]; ?>" readonly>
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" id="pass" class="form-control">
</div>
<button type="submit" name="add" class="btn btn-primary">Submit</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<!-- =========Edit ADMIN ===========-->
<div class="modal fade" id="edit-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="" method="POST" name="submit-data" onsubmit="return validateform()">
<div class="form-group">
<label for="username">Username</label>
<input type="text" id="user" name="username" class="form-control">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" id="pass" name="password" class="form-control">
</div>
<button type="submit" name="edit" class="btn btn-primary">Edit</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function validateform() {
	var user = document.forms["submit-data"]["user"].value;
	var pass = document.forms["submit-data"]["pass"].value;
	var email = document.forms["submit-data"]["email"].value;
	if (user == "") {
		alert("Username must be filled out!");
		return false;
	}else if (pass == "") {
		alert("Password must be filled out!");
		return false;
	}else if (email == "") {
		alert("Email must be filled out!");
		return false;
	}
	// body...
}
</script>
<?php include_once "header/footer.php"; ?>
