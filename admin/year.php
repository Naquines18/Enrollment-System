<?php
timezone_open("Asia/Manila");
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

<title>Dashboard - School Year Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<button class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#add-year">Add School Year</button>

<!-- End of Topbar -->
<!-- DataTales Example -->
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

<?php
if (isset($_GET["success_edit"])) {
  echo"
      <div class='alert alert-success'>
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <h5>".$_GET["success_edit"]."</h5>
      </div>
      ";
}

?>

<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">School Year Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>School-Year</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>School-Year</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody><?php
include_once("initialize/config.php");

$query = "SELECT * FROM schoolyear";
$years = mysqli_query($config,$query);
foreach ($years as $year){
?>
<tr>
<td><?php echo $year["schoolyear"]; ?></td>
<td><time><?php echo $year["created"]; ?></time></td>
<td><a href="action-delete/delete-year.php?id=<?php echo $year["id"] ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-year.php?id=<?php echo $year["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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
<!-- START OF update YEAR -->
<div class="modal fade" id="add-year" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add School Year</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="actions/add-year.php" method="POST" name="year" onsubmit="return validateform()">
<div class="form-group">
<label for="position">School-Year</label>
<input type="text" name="year" id="year" class="form-control">
</div>
<button type="submit" name="add" class="btn btn-primary">Create</button>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<script type="text/javascript">

  function validateform(){
    var year = document.forms["year"]["year"].value;

    if (year == "") {
      alert("School-Year must be filled out!");
      return false;
    }
  }

  $(document).ready(function(){
    $("#dataTable").DataTable();
  });
</script>
<?php include_once "header/footer.php"; ?>
