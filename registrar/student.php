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
<meta name="description" content="Enrollment System for Sta.Marhta Educational Center">
<title>Dashboard - Student Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
  <div align="left">
<?php
if (isset($_GET["info"])) {
 echo"
 <div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <h5>".$_GET["info"]."</h5>
</div>
 ";
}

?>
</div>
<!-- End of Topbar -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Enrolled Student Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr class="text-center">
<th>Student ID</th>
<th>Surname</th>
<th>FirstName</th>
<th>MiddleInitial</th>
<th>Course</th>
<th>Birth Place</th>
<th>Contact Number</th>
<th>Sex</th>
<th>Father's Name</th>
<th>Mother's Name</th>
<th>Father's Occupation</th>
<th>Mother's Occupation</th>
<th>Guardian</th>
<th>Guardian Address</th>
<th>Guardian Relationship</th>
<th>Grade Level</th>
<th>Address</th>
<th>Religion</th>
<th>School-Year</th>
<th>Status</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>

<tr class="text-center">
<th>Student ID</th>
<th>Surname</th>
<th>Firstname</th>
<th>MiddleInitial</th>
<th>Course</th>
<th>Birth Place</th>
<th>Contact Number</th>
<th>Sex</th>
<th>Fathers Name</th>
<th>Mothers Name</th>
<th>Father Occupation</th>
<th>Mother Occupation</th>
<th>Guardian</th>
<th>Guardian Address</th>
<th>Guardian Relationship</th>
<th>Grade Level</th>
<th>Address</th>
<th>Religion</th>
<th>School-Year</th>
<th>Status</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM enrollies";
$enrollies = mysqli_query($config,$query);
foreach ($enrollies as $enrollie){
?>
<tr class="text-center">
<td><?php echo $enrollie["student_id"]; ?></td>
<td><?php echo $enrollie["surname"]; ?></td>
<td><?php echo $enrollie["firstname"]; ?></td>
<td><?php echo $enrollie["middlename"]; ?></td>
<td><?php echo $enrollie["course"]; ?></td>
<td><?php echo $enrollie["birth_place"]; ?></td>
<td><?php echo $enrollie["contact_number"]; ?></td>
<td><?php echo $enrollie["sex"]; ?></td>
<td><?php echo $enrollie["fathersname"]; ?></td>
<td><?php echo $enrollie["mothersname"]; ?></td>
<td><?php echo $enrollie["father_occupation"]; ?></td>
<td><?php echo $enrollie["mother_occupation"]; ?></td>
<td><?php echo $enrollie["guardian"]; ?></td>
<td><?php echo $enrollie["guardian_addr"]; ?></td>
<td><?php echo $enrollie["guardian_relation"]; ?></td>
<td><?php echo $enrollie["grade_level"]; ?></td>
<td><?php echo $enrollie["addr"]; ?></td>
<td><?php echo $enrollie["religion"]; ?></td>
<td><?php echo $enrollie["schoolyear"]; ?></td>
<td>
<?php

if (isset($_POST["enroll"])) {
  $id = $_POST["id"];
  $update = mysqli_query($config,"UPDATE enrollies SET status='Enrolled' WHERE id='".$id."'");
  $update = mysqli_query($config,"UPDATE registered SET status='Enrolled' WHERE name='".$enrollie["name"]."'");

    echo "<script>window.location.href='student.php?info=Data updated successfully!'</script>";

}

if (isset($_POST["unenroll"])) {
  $id = $_POST["id"];
  $update = mysqli_query($config,"UPDATE enrollies SET status='Pending' WHERE id='".$id."'");
  $update = mysqli_query($config,"UPDATE registered SET status='Pending' WHERE name='".$enrollie["name"]."'");
  echo "<script>window.location.href='student.php?info=Data updated successfully!'</script>";
}

if ($enrollie["status"] == "Pending") {
  echo "
  <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
  <input type='hidden' name='id' value='".$enrollie["id"]."'>
  <button type='submit' class='btn btn-outline-warning' name='enroll'>Pending</button>
  </form>
  ";
}elseif($enrollie["status"] == "Enrolled"){
   echo "
  <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
  <input type='hidden' name='id' value='".$enrollie["id"]."'>
  <button type='submit' class='btn btn-outline-info' name='unenroll'>Enrolled</button>
  </form>
  ";
}

?>
</td>
<td><a href="action-delete/delete-student.php?id=<?php echo $enrollie["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-student.php?id=<?php echo $enrollie["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

</div>


<div class="container">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Students Birth Certificate, Good Moral, Report Card</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTableImages" width="100%" cellspacing="0">
<thead>
<tr class="text-center">
<th>No.</th>
<th>Student Name</th>
<th>Report Card</th>
<th>Good Moral</th>
<th>Birth Certificate</th>
</tr>
</thead>
<tfoot>
<tr>

<tr class="text-center">
<th>No.</th>
<th>Student Name</th>
<th>Report Card</th>
<th>Good Moral</th>
<th>Birth Certificate</th>
</tr>
</tr>
</tfoot>
<tbody>
<?php
$i = 1;
$query = "SELECT * FROM data_images INNER JOIN registered ON data_images.user_id = registered.id";
$images = mysqli_query($config,$query);
foreach ($images as $image){

  $is_pdf0 = (strpos($image['report_card'],"pdf"))? 'pdf':'image';
  $is_pdf1 = (strpos($image['good_moral'],"pdf"))? 'pdf':'image';
  $is_pdf2 = (strpos($image['birth_cert'],"pdf"))? 'pdf':'image';
?>
<tr class="text-center">
<td><?php echo $i++; ?></td>
<td><?php echo $image["name"]; ?></td>
<td>
  <?php 
    if($is_pdf0 == "pdf"){
      echo '<a href="../admin/data_image/cards/'.$image["report_card"].' " class="btn btn-info" target="__blank">View Pdf Report Card</a>';
    }else{
      echo '<img width="100px" height="100px" src="../admin/data_image/cards/'. $image["report_card"].'" id="view_image" style="cursor:pointer" onclick=window.open(this.src,"_blank");>';
    }
  ?>
</td>
<td>
<?php 
    if($is_pdf1 == "pdf"){
      echo '<a href="../admin/data_image/good_moral/'.$image["good_moral"].'" target="_blank" class="btn btn-info" target="__blank">View Pdf Good Moral</a>';
    }else{
      echo '<img width="100px" height="100px" src="../admin/data_image/good_moral/'.$image["good_moral"].'" id="view_image" style="cursor:pointer" onclick=window.open(this.src,"_blank");>';
    }
  ?>
  
</td>
<td>
<?php 
    if($is_pdf2 == "pdf"){
      echo '<a target="__blank" href="../admin/data_image/birth/'.$image["birth_cert"].'?download=false" target="_blank" class="btn btn-info">View Pdf Birth Cert</a>';
    }else{
      echo '<img width="100px" height="100px" src="../admin/data_image/birth/'.$image["birth_cert"].'" id="view_image" style="cursor:pointer" onclick=window.open(this.src,"_blank");>';
    }
  ?>
  
</td>
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


<script type="text/javascript">
  $(document).ready(function(){
    $("#dataTable").DataTable();
    $("#dataTableImages").DataTable();
  });


  
  
</script>
<?php include_once "header/footer.php"; ?>
