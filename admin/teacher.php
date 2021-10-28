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
<title>Dashboard - Teacher Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#add-teacher">Add Teacher</button>
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Teacher Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Position</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>Email</th>
<th>Position</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM teachers";
$teachers = mysqli_query($config,$query);
foreach ($teachers as $teacher){
?>
<tr>
<td><?php echo $teacher["name"]; ?></td>
<td><?php echo $teacher["email"]; ?></td>
<td><?php echo $teacher["position"]; ?></td>
<td><a href="action-delete/delete-teacher.php?id=<?php echo $teacher["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-teacher.php?id=<?php echo $teacher["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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
<!-- Add teacher-->
<div class="modal fade" id="add-teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="actions/add-teacher.php" method="POST" name="add" id="add" onsubmit="return validate()">
<div class="form-group">
<label for="name">Full Name</label>
<input type="text" name="name" id="name" class="form-control">
</div>

<div class="form-group">
<label for="email">Email address</label>
<input type="email" name="email" id="email" class="form-control">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>

<div class="form-group">
  <label for="inputState">Teacher Position</label>
  <select id="inputState" class="form-control" name="position" id="position">
            <option value="" selected>Select Teacher's Position</option>

    <?php
    include_once "initialize/config.php";
    $select = mysqli_query($config, "SELECT * FROM position");
    while ($row = mysqli_fetch_assoc($select)) {
        ?>
        <option><?php echo $row["position"]; ?></option>
      <?php } ?>
  </select>
</div>
<button type="submit" name="add" id="add" class="btn btn-outline-primary">Add Teacher</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<!-- Delete teacher-->
<div class="modal fade" id="delete-teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this record!</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<a href="delete.php" class="btn btn-primary">Confirm</a>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">

  function validate(){
    var name = document.forms["add"]["name"].value;
    var email = document.forms["add"]["email"].value;
    var position = document.forms["add"]["position"].value;

    if (name == "") {
      alert("Teacher name must be filled out!");
      return false;
    }else if (email == "") {
      alert("Teacher email must be filled out!");
      return false;
    }else if (position == "") {
      alert("Teacher position must be filled out!");
      return false;
    }

  }

  $(document).ready(function(){
    $("#dataTable").DataTable();
  });
</script>
<?php include_once "header/footer.php"; ?>
