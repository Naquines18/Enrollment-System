<?php

include "initialize/config.php";

session_start();
if(!isset($_SESSION["name"]) AND $_SESSION["name"] == false){
header("location: ../../login.php");
}
?>
<?php
if(isset($_GET['error_enroll'])){
  echo '<script>
        alert("'.$_GET["error_enroll"].'")
      </script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta.Martha Educational Center">
<title>SMEC</title>
<?php include "header/link-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<?php
include_once "initialize/config.php";

$check = "SELECT status FROM enrollies WHERE name='".$_SESSION["name"]."' LIMIT 1";
$check_run = mysqli_query($config,$check);

while($row = mysqli_fetch_array($check_run)){
$status = $row["status"];

if ($status == "Enrolled") {
echo "<div class='container'><div class='alert alert-success alert-dismissible fade show' role='alert'>
   <h5>Success you are now Enrolled in Sta. Martha Educational Center!</h5>
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

}else{
        echo '<div class="container mb-4">
      <button type="button" class="btn btn-primary bt-sm btn-block" data-toggle="modal" data-target="#enroll">
      Enroll Now
      </button>
      </div>';
}

}

?>
<?php
 $check = mysqli_query($config,"SELECT `status` FROM registered WHERE id='".$_SESSION["STUDENT_ID"]."' LIMIT 1");
  while ($row = mysqli_fetch_array($check)) {
    $status = $row["status"];
    if ($status == "Enrolled") {

    }elseif ($status == "Pending") {
      echo "
      <div class='container'>
        <div class='alert alert-info alert-dismissible fade show' role='alert''>
          <h5> Your Status now is Pending</h5>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button>
        </div>
      </div>";
    }else{
      echo '<div class="container mb-4">
          <button type="button" class="btn btn-primary bt-sm btn-block" data-toggle="modal" data-target="#enroll">
            Enroll Now
          </button>
      </div>';
    }
  }
?>



<!-- Content Row -->
<div class="container row">
<div class="col-xl-6 col-md-6 col-md-12 mb-4">
<div class="card border-left-primary shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
<i class="fas fa-check-circle"></i>
Total Enrollies</div>
<?php
include_once("initialize/config.php");
$query = "SELECT * FROM enrollies WHERE status='enrolled'";
$enrolies = mysqli_query($config,$query);
$enrolies_count = mysqli_num_rows($enrolies);
?>
<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $enrolies_count; ?></div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-6 col-md-6 col-md-12 mb-4">
<div class="card border-left-success shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
	<i class="fas fa-check-circle"></i>
Total Teachers</div>
<?php
include_once("initialize/config.php");

$query = "SELECT * FROM teachers";
$teachers = mysqli_query($config,$query);
$teacher_cont = mysqli_num_rows($teachers);
?>
<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $teacher_cont; ?></div>
</div>
<div class="col-auto">
<i class="fas fa-angle-double-left"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-md-6 col-md-12 mb-4">
<div class="card border-left-info shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
<i class="fas fa-check-circle"></i>
Expected Enrollies
</div>
<div class="row no-gutters align-items-center">
<div class="col-auto">
<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">100%</div>
</div>
<div class="col">
<div class="progress progress-sm mr-2">
<div class="progress-bar bg-info" role="progressbar"
style="width: 100%" aria-valuenow="100" aria-valuemin="0"
aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>


<!-- Enroll -->
<div class="modal fade" id="enroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Enrollment Form</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<form action="actions/enroll.php" method="POST" name="process_data" onsubmit="return validateForm()" enctype="multipart/form-data">
  <input type="hidden" name="name" id="name" value="<?php echo $_SESSION["name"]; ?>">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Surname</label>
      <input type="text" name="sname" class="form-control" id="sname" maxlength="20">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Firstname</label>
      <input type="text" name="fname" class="form-control" id="fname" maxlength="20">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Middlename</label>
      <input type="text" name="midname" class="form-control" id="midname" maxlength="40">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Select Strand</label>
      <select id="inputState" name="course" class="form-control" id="course">
        <option selected>Select Strand</option>
       <?php
        $select = "SELECT * FROM course";
        $run = mysqli_query($config,$select);
        foreach ($run as $key) {
            echo "<option value='".$key["course_id"]."'>".$key["course_id"].". ".$key["course"]."</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group col-md-5">
      <label for="inputPassword4">Birthplace</label>
      <input type="text" class="form-control" name="birthplace" id="birthplace">
    </div>
  </div>

   <div class="form-group">
    <label for="inputMobile">Mobile Number</label>
    <input type="text" class="form-control" name="mobile" placeholder="+6391036305252" id="mobile" maxlength="14" min="14">
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="gender">Gender</label>
      <select class="form-control" name="sex">
      <option value="" selected="">Select</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Fathersname</label>
      <input type="text" class="form-control" name="fathername" id="fathername"  maxlength="20">
    </div>
    <div class="form-group col-md-5">
      <label for="inputPassword4">Mothersname</label>
      <input type="text" class="form-control" name="mname" id="mname" maxlength="20">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Father Occupation</label>
      <input type="text" class="form-control" name="fatherocc" id="fatherocc" maxlength="30">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Mother Occupation</label>
      <input type="text" class="form-control" name="motherocc" id="motherocc" maxlength="30">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Guardian</label>
      <input type="text" class="form-control" name="guardian" id="guardian" maxlength="30">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Guardian Address</label>
      <input type="text" class="form-control" name="guardianaddr" id="guardianaddr" maxlength="100">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputrelationship">Guardian Relationship</label>
      <input type="text" class="form-control" name="relation" id="relation" maxlength="30">
    </div>
     <div class="form-group col-md-6">
      <label for="inputState">Grade</label>
      <select id="inputState" class="form-control" name="grade" id="grade">
        <option selected>Current Grade</option>
       <?php
        $select = "SELECT * FROM grade_levels";
        $run = mysqli_query($config,$select);
        foreach ($run as $key) {
            echo "<option value='".$key["grade_level"]."'>".$key["grade_level"]."</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Address</label>
      <input type="text" class="form-control" name="address" id="address" maxlength="100">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Religion</label>
      <input type="text" class="form-control" name="religion" id="religion" maxlength="30">
    </div>
  </div>

  <div class="form-group">
      <label for="inputState">School Year</label>
      <select id="inputState" class="form-control" name="year" id="year">
        <option selected>Select School Year</option>
       <?php
        $select = "SELECT * FROM schoolyear";
        $run = mysqli_query($config,$select);
        foreach ($run as $key) {
            echo "<option value='".$key["schoolyear"]."'>".$key["schoolyear"]."</option>";
        }
        ?>
      </select>
    </div>

    <div class="custom-file mb-3">
        <label for="birth_cert" class="custom-file-label">Upload Birth Certificate</label>
        <input accept="application/pdf,image/png,image/jpeg,image/gif" type="file" class="custom-file-input" name="birth_cert" id="birth_cert" required>
    </div>

    <div class="custom-file mb-3">
        <label for="good_moral" class="custom-file-label">Upload Good Moral</label>
        <input accept="application/pdf,image/png,image/jpeg,image/gif" type="file" name="good_moral" class="custom-file-input" id="good_moral" required>
    </div>

    <div class="custom-file mb-3">
        <label class="custom-file-label" for="report_card">Upload Report Card</label>
        <input accept="application/pdf,image/png,image/jpeg,image/gif" type="file" name="report_card" class="custom-file-input" id="report_card" required>
    </div>

  <button type="submit" class="btn btn-outline-primary" name="submit" id="submit">Submit Enrollment Data</button>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<script type="text/javascript">
 function validateForm() {
    var x = document.forms["process_data"]["sname"].value;
    var f = document.forms["process_data"]["fname"].value;
    var m = document.forms["process_data"]["midname"].value;
    var c = document.forms["process_data"]["course"].value;
    var b = document.forms["process_data"]["birthplace"].value;
    var mobile = document.forms["process_data"]["mobile"].value;
    var sex = document.forms["process_data"]["sex"].value;
    var fathername = document.forms["process_data"]["fathername"].value;
    var mname = document.forms["process_data"]["mname"].value;
    var fatherocc = document.forms["process_data"]["fatherocc"].value;
    var motherocc = document.forms["process_data"]["motherocc"].value;
    var guardian = document.forms["process_data"]["guardian"].value;
    var guardianaddr = document.forms["process_data"]["guardianaddr"].value;
    var relation = document.forms["process_data"]["relation"].value;
    var year = document.forms["process_data"]["year"].value;

    if (x == "") {
        alert("Surname must be filled out");
        return false;
    }else if (f == "") {
        alert("Firstname must be filled out");
        return false;
    }else if (m == "") {
        alert("Middlename must be filled out");
        return false;
    }else if (c == "") {
        alert("Course must be filled out");
        return false;
    }else if (b == "") {
        alert("Birthplace must be filled out");
        return false;
    }else if (mobile == "") {
        alert("Mobile must be filled out");
        return false;
    }else if (sex == "") {
        alert("Gender must be filled out");
        return false;
    }else if (fathername == "") {
        alert("Father's Name must be filled out");
        return false;
    }else if (mname == "") {
        alert("Mother's Name must be filled out");
        return false;
    }else if (fatherocc == "") {
        alert("Father's Occupation must be filled out");
        return false;
    }else if (motherocc == "") {
        alert("Mother's Occupation must be filled out");
        return false;
    }else if (guardian == "") {
        alert("Guardian must be filled out");
        return false;
    }else if (guardianaddr == "") {
        alert("Guardian Address must be filled out");
        return false;
    }else if (relation == "") {
        alert("Guardian Relationship must be filled out");
        return false;
    }else if (year == "") {
        alert("School Year must be filled out");
        return false;
    }

   

}
</script>
<?php include_once "header/footer.php"; ?>
<?php include "header/script.php"; ?>
<script>
   $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>
