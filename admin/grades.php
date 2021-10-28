<?php
session_start();
include "initialize/config.php";

if(!isset($_SESSION["username"]) AND $_SESSION["username"] == false){
header("location: ../../login.php");
}


if (isset($_POST["save"])) {
  $student_name = $_POST["student_name"];
  $course = $_POST["course"];
  $subject = $_POST["subject"];
  $final_grade = $_POST["final_grade"];

  $update = $config->prepare("INSERT INTO grades (`student_name`, `course`, `subject`, `final_grade`) VALUES (?,?,?,?)");
  $update->bind_param("sssi",$student_name,$course,$subject,$final_grade);
  $update->execute();
  switch ($update == true) {
    case 'Success':
    header("location: grades.php?success=The Data is save successfully");
      break;

    default:
    header("location: grades.php?fail=Failed to save the grades");
      break;
  }
  $update->close();
  $config->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Academy">
<meta name="author" content="Kian Naquines">
<title>Dashboard - Student Management</title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">


<?php include_once "header/nav.php"; ?>

<?php
include_once "initialize/config.php";

$check = "SELECT status FROM enrollies WHERE name='".$_SESSION["username"]."' LIMIT 1";
$check_run = mysqli_query($config,$check);

while($row = mysqli_fetch_array($check_run)){
$status = $row["status"];

if ($status == "Enrolled") {
echo "<div class='container'><div class='alert alert-success alert-dismissible fade show' role='alert'>
   <h5>Success you are now Enrolled in Sta. Martha Academy!</h5>
   <p>View your profile, just click your profile photo!</p>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";
}elseif($status == "Pending"){
echo "<div class='container'><div class='alert alert-info alert-dismissible fade show' role='alert'>
<h5>Please pay in the cashier for you to be Enroll!</h5>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";

}

}

?>
<?php
if (isset($_GET["success"])) {
    echo "
    <div class='container'><div class='alert alert-success alert-dismissible fade show' role='alert'>
   <h5>".$_GET["success"]."</h5>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";
}

?>

<div class="container-fluid">
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#grades">Manage Grades</button>
<!-- DataTales Example -->
<div class="card shadow mb-4 mt-3">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Student's Grades</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Student Name</th>
<th>Course</th>
<th>Subject</th>
<th>Final Grade</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Student Name</th>
<th>Course</th>
<th>Subject</th>
<th>Final Grade</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</tfoot>
<tbody>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM grades";
$grades = mysqli_query($config,$query);
foreach ($grades as $grade){
?>
<tr>
<td><?php echo $grade["student_name"]; ?></td>
<?php
$query = "SELECT * FROM course WHERE course_id='".$grade["course"]."'";
$course = mysqli_query($config,$query);
while ($course1 = mysqli_fetch_assoc($course)) { ?>
<td><?php echo $course1["course"]; ?></td>
<?php } ?>
<td><?php echo $grade["subject"]; ?></td>
<td><?php echo $grade["final_grade"]; ?></td>
<td><a href="action-delete/delete-grades.php?id=<?php echo $grade["id"]; ?>" class="btn btn-outline-danger">Delete</a></td>
<td><a href="action-update/edit-grades.php?id=<?php echo $grade["id"]; ?>" class="btn btn-outline-primary">Edit</a></td>
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

<!-- Modal -->
<div class="modal fade" id="grades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Grades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form action="" method="POST">
          <div class="row">
            <div class="col">
              <label>Student Name</label>
              <select id="inputState" name="student_name" class="form-control" id="student_name">
                  <option selected>Select Student</option>
                 <?php
                  $select = "SELECT * FROM enrollies";
                  $run = mysqli_query($config,$select);
                  foreach ($run as $key) {
                  echo "<option value='".$key["name"]."'>".$key["id"].". ".$key["name"]."</option>";
                  }
                  ?>
                </select>
              </div>
            <div class="col">
                <label for="inputState">Select Course</label>
                <select id="inputState" name="course" class="form-control" id="course">
                  <option selected>Select Course</option>
                 <?php
                  $select = "SELECT * FROM course";
                  $run = mysqli_query($config,$select);
                  foreach ($run as $key) {
                  echo "<option value='".$key["course_id"]."'>".$key["course_id"].". ".$key["course"]."</option>";
                  }
                  ?>
                </select>
            </div>
          </div>
          <br>
           <div class="row">
            <div class="col">
              <label>Subject</label>
             <select id="inputState" name="subject" class="form-control" id="course">
                  <option selected>Select Subjects</option>
                 <?php
                  $select = "SELECT * FROM subject";
                  $run = mysqli_query($config,$select);
                  foreach ($run as $key) {
                  echo "<option value='".$key["id"]."'>".$key["id"].". ".$key["subject"]."</option>";
                  }
                  ?>
                </select>
            </div>
            <div class="col">
                <label for="inputState">Grade</label>
                <select id="inputState" name="final_grade" class="form-control" id="final_grade">
                  <option selected>Select Grades</option>
                  <option value="1.00">1.00</option>
                  <option value="1.25">1.25</option>
                  <option value="1.50">1.50</option>
                  <option value="1.75">1.75</option>
                  <option value="2.00">2.00</option>
                  <option value="2.25">2.25</option>
                  <option value="2.50">2.50</option>
                  <option value="2.75">2.75</option>
                  <option value="3.00">3.00</option>
                  <option value="5.00">5.00</option>
                  <option value disabled>—————————————</option>
                  <option value disabled>For High School</option>
                  <option value="70%">70</option>
                  <option value="71%">71</option>
                  <option value="72%">72</option>
                  <option value="73%">73</option>
                  <option value="74%">74</option>
                  <option value="77%">77</option>
                  <option value="78%">78</option>
                  <option value="79%">79</option>
                  <option value="80%">80</option>
                  <option value="81%">81</option>
                  <option value="82%">82</option>
                  <option value="83%">83</option>
                  <option value="84%">84</option>
                  <option value="85%">85</option>
                  <option value="86%">86</option>
                  <option value="87%">87</option>
                  <option value="88%">88</option>
                  <option value="89%">89</option>
                  <option value="90%">90</option>
                  <option value="91%">91</option>
                  <option value="92%">92</option>
                  <option value="93%">93</option>
                  <option value="94%">94</option>
                  <option value="95%">95</option>
                  <option value="96%">96</option>
                  <option value="97%">97</option>
                  <option value="98%">98</option>
                  <option value="99%">99</option>
                  <option value="100%">100</option>
                </select>
            </div>
          </div>
          <div class="form-group mt-4">
            <button class="btn btn-outline-primary" name="save">Save</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!-- End of Main Content -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#dataTable").DataTable();
	});
</script>
<?php include_once "header/footer.php"; ?>
<?php include "header/script.php"; ?>
</body>
</html>
