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
<title>Dashboard - Subject and Schedules Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">

<?php include_once "header/nav.php"; ?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<button class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#course">Add Course</button>
<h6 class="m-0 font-weight-bold text-primary">
Courses Management</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Course ID</th>
<th>Course</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Course ID</th>
<th>Course</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>

</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM course";
$courses = mysqli_query($config,$query);
foreach ($courses as $course){
?>
<tr>
<td><?php echo $course["course_id"]; ?></td>
<td><?php echo $course["course"]; ?></td>
<td><?php echo $course["created"]; ?></td>
<td><a href="action-delete/delete-course.php?course_id=<?php echo $course["course_id"] ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-course.php?course_id=<?php echo $course["course_id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<?php include_once "header/nav.php"; ?>
<div class="container-fluid">

<div class="card shadow mb-4">
<div class="card-header py-3">
  <button class="btn btn-outline-primary mb-3"data-toggle="modal" data-target="#subject">Add Student Schedule</button>
<h6 class="m-0 font-weight-bold text-primary">Student,Subject's and its schedule's Mnanagement
</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
<thead>
<tr>
<th>Subject ID</th>
<th>Student Name</th>
<th>Course ID</th>
<th>Subject</th>
<th>Day</th>
<th>Time</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Subject ID</th>
<th>Student Name</th>
<th>Course ID</th>
<th>Subject</th>
<th>Day</th>
<th>Time</th>
<th>Created</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM subjects";
$subjects = mysqli_query($config,$query);
foreach ($subjects as $subject){
?>
<tr>
<td><?php echo $subject["id"]; ?></td>
<td><?php echo $subject["student_name"]; ?></td>
<td><?php echo $subject["course_id"]; ?></td>
<td><?php echo $subject["subject"]; ?></td>
<td><?php echo $subject["schedule"]; ?></td>
<td><?php echo $subject["oras"]; ?></td>
<td><?php echo $subject["created"]; ?></td>
<td><a href="action-delete/delete-subject.php?id=<?php echo $subject["id"] ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-subject.php?id=<?php echo $subject["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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



</div>
</div>
</div>


<?php
if (isset($_POST["update1"])) {
  include_once "initialize/config.php";
  $course = $_POST["course"];
  $date = date("Y-m-d H:i:s");

  $stmt = $config->prepare("INSERT INTO course(course,created) VALUES(?,?)");
  $stmt->bind_param("ss",$course,$date);
  $stmt->execute();
  if ($stmt == true) {

    create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Course')");

    echo "<script>window.location.href='subject-sched.php?success=New added course'</script>";
    die();
  }else{
    echo "<script>window.location.href='subject-sched.php?success=Could not add course'</script>";
    die();
  }
  $stmt->close();
  $config->close();

}

?>
<!-- Modal -->
<div class="modal fade" id="course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" name="insert-1" onsubmit="return validate1()">
          <div class="form-group">
            <label for="exampleInputEmail1">Add Course</label>
            <input type="text" name="course" class="form-control" name="course">
            <small id='course' class='form-text text-muted'>Course</small>
          </div>
          <button type="submit" name="update1" class="btn btn-primary">Save</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
if (isset($_POST["update"])) {
  include_once "initialize/config.php";
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  $schedule = $_POST["schedule"];
  $oras = $_POST["oras"];
  $course_id = $_POST["course"];
  $date = date("Y-m-d H:i:s");

  $stmt = $config->prepare("INSERT INTO subjects(student_name,course_id,subject,schedule,oras,created) VALUES(?,?,?,?,?,?)");
  $stmt->bind_param("sissss",$name,$course_id,$subject,$schedule,$oras,$date);
  $stmt->execute();
  if ($stmt == true) {
    echo "<script>window.location.href='subject-sched.php?success=New added subject'</script>";
    die();
  }else{
    echo "<script>window.location.href='subject-sched.php?success=Could not add a data'</script>";
    die();
  }
  $stmt->close();
  $config->close();

}

?>
<!-- Modal -->
<div class="modal fade" id="subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student,Subject's and its schedule's</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="insert" name="insert" onsubmit="return validate()">
           <div class="form-group">
            <label for="exampleInputEmail1">Student</label>
            <select class="form-control" id="name" name="name">
              <option value="" selected>Select Student</option>
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
            <label for="exampleInputEmail1">Add Subject</label>
             <select class="form-control" id="subject" name="subject">
              <option value="" selected>Select Subject</option>
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
            <label for="exampleFormControlSelect1">Course</label>
            <select class="form-control" id="course" name="course">
              <option value="" selected>Select Course</option>
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
            <label for="exampleFormControlSelect1">Select Day</label>
            <select class="form-control" id="schedule" name="schedule">
              <option value="" selected>Select Day</option>
              <?php
              $select = mysqli_query($config,"SELECT * FROM schedule");
              while ($row = mysqli_fetch_assoc($select)) {
              ?>
              <option value="<?php echo $row["schedule"];  ?>"><?php echo $row["schedule_id"];  ?>. <?php echo $row["schedule"] ?></option>
              <?php
              }
              ?>

            </select>
          </div>

          <div class="form-group">
           <label for="exampleFormControlSelect1">Select Time</label>
           <select class="form-control" id="oras" name="oras">
             <option value="" selected>Select Time</option>
             <?php
             $select = mysqli_query($config,"SELECT * FROM oras");
             while ($row = mysqli_fetch_assoc($select)) {
             ?>
             <option value="<?php echo $row["oras"];  ?>"><?php echo $row["id"];  ?>. <?php echo $row["oras"] ?></option>
             <?php
             }
             ?>

           </select>
         </div>
          <button type="submit" name="update" id="try123" class="btn btn-primary">Save</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">

  function validate1(){
    var course = document.forms["insert1"]["name"].value;


    if (course == "") {
      alert("Course must be filled out");
      return false;
    }
  }

  function validate(){
    var name = document.forms["insert"]["name"].value;
    var subject = document.forms["insert"]["subject"].value;
    var course = document.forms["insert"]["course"].value;
    var schedule = document.forms["insert"]["schedule"].value;

    if (name == "") {
      alert("Student name must be filled out");
      return false;
    }else if (subject == "") {
      alert("Subject must be filled out");
      return false;
    }else if (course == "") {
      alert("Course must be filled out");
      return false;
    }else if (schedule == "") {
      alert("Schedule must be filled out");
      return false;
    }
  }

  $(document).ready(function(){
    $("#dataTable").DataTable();
    $("#dataTables").DataTable();

 });
</script>
<?php include_once "header/footer.php"; ?>
