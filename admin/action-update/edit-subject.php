<?php
session_start();

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}
include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

   $select = mysqli_query($config,"SELECT * FROM subjects WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
      $id = $row["id"];
      $name = $row["student_name"];
      $subject = $row["subject"];
      $course_id = $row["course_id"];
      $schedule = $row["schedule"];
      $oras = $row["oras"];
      $created = $row["created"];

   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Adminpanel</title>
<?php include "header/style-cdn.php"; ?>
</head>

<body id="page-top">
<?php include_once "header/nav.php"; ?>
<?php
if (isset($_POST["update"])) {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  $course_id = $_POST["course_id"];
  $schedule = $_POST["schedule"];
  $oras = $_POST["oras"];
  $date = date("Y-m-d H:i:s");

  $stmt = $config->prepare("UPDATE subjects SET student_name = ? , course_id= ? , subject = ?, schedule = ? , oras = ? , created = ? WHERE id = ?");
  $stmt->bind_param("sissssi",$name,$course_id,$subject,$schedule,$oras,$date,$id);
  $stmt->execute();
  if ($stmt == true) {
    echo "<script>window.location.href='../subject-sched.php?success=New added subject'</script>";
    die();
  }else{
    echo "<script>window.location.href='../subject-sched.php?success=Could not add a data'</script>";
    die();
  }
  $stmt->close();
  $config->close();
}

?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Update Subject (<?php echo $subject; ?>)</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-6">
				<form action="edit
				-subject.php" method="POST" id="update">
				<div class="form-group">
				    <label for="exampleInputEmail1">Student</label>
				    <input type="hidden" name="id" value="<?php echo $id; ?>">
				    <select class="form-control" id="name" name="name">
		              <option selected><?php echo $name; ?></option>
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM enrollies");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["name"]; ?>"><?php echo $row["id"];  ?>. <?php echo $row["name"]; ?></option>
		              <?php
		              }
		              ?>

		            </select>
				  </div>
				  <div class="form-group">
				     <label for="exampleFormControlSelect1">Course</label>
		            <select class="form-control" id="course" name="course_id">
		            	 <?php
		              $select = mysqli_query($config,"SELECT * FROM course WHERE course_id = '".$course_id."'");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $course_id; ?>" selected><?php echo $row["course"]; ?></option>
		          <?php } ?>
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM course");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["course_id"];  ?>"><?php echo $row["course_id"];  ?>. <?php echo $row["course"] ?></option>
		              <?php
		              }
		              ?>

		            </select>
				  </div>
				  <div class="form-group">
		            <label for="exampleFormControlSelect1">Subject</label>
		            <select class="form-control" name="subject">
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM subject WHERE id = '".$subject."'");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["id"]; ?>" selected><?php echo $row["subject"]; ?></option>
		          		<?php } ?>
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM subject");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["subject"];  ?>"><?php echo $row["id"];  ?>. <?php echo $row["subject"] ?></option>
		              <?php
		              }
		              ?>

		            </select>
		          </div>
		           <div class="form-group">
		            <label for="exampleFormControlSelect1">Select Day</label>
		            <select class="form-control" name="schedule">
		              <option selected="">Select Day</option>
		              <?php
		              $select = mysqli_query($config,"SELECT * FROM schedule");
		              while ($row = mysqli_fetch_assoc($select)) {
		              ?>
		              <option value="<?php echo $row["schedule"];  ?>"><?php echo $row["schedule_id"];?>. <?php echo $row["schedule"] ?></option>
		              <?php
		              }
		              ?>

		            </select>
          </div>
          <div class="form-group">
           <label for="exampleFormControlSelect1">Select Time</label>
           <select class="form-control" name="oras">
             <option selected="">Select Time</option>
             <?php
             $select = mysqli_query($config,"SELECT * FROM schedule");
             while ($row = mysqli_fetch_assoc($select)) {
             ?>
             <option value="<?php echo $row["oras"];  ?>"><?php echo $row["schedule_id"];?>. <?php echo $row["oras"] ?></option>
             <?php
             }
             ?>

           </select>
     </div>
				  <button type="submit" name="update" id="update" class="btn btn-primary">Update</button>
				</form>
		</div>
	</div>

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


    });
</script>
<?php include_once "header/footer.php"; ?>
