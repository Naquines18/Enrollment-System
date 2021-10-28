<?php
session_start();
include "../initialize/config.php";

if(!isset($_SESSION["username"]) AND $_SESSION["username"] !== true){
header("location: ../../index.php");
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $check = mysqli_query($config,"SELECT * FROM enrollies WHERE id=$id");
  $check1 = mysqli_num_rows($check);
  if ($check1 == 1) {
    $select = mysqli_query($config,"SELECT * FROM enrollies WHERE id=$id");
   while ($row = mysqli_fetch_assoc($select)) {
       $id = $row["id"];
       $surname = $row["surname"];
       $firstname = $row["firstname"];
       $middlename = $row["middlename"];
       $course = $row["course"];
       $birth_place = $row["birth_place"];
       $contact_number = $row["contact_number"];
       $sex = $row["sex"];
       $fathersname = $row["fathersname"];
       $mothersname = $row["mothersname"];
       $father_occupation = $row["father_occupation"];
       $mother_occupation = $row["mother_occupation"];
       $guardian = $row["guardian"];
       $guardian_addr = $row["guardian_addr"];
       $guardian_relation = $row["guardian_relation"];
       $grade_level = $row["grade_level"];
       $addr = $row["addr"];
       $religion = $row["religion"];
      $year = $row["schoolyear"];

   }
  }else{
  header("location: ../dashboard.php?error= No user associated with that ID");
  }


}else{
  header("location: ../student.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sname = mysqli_real_escape_string($config,$_POST["sname"]);
    $fname = mysqli_real_escape_string($config,$_POST["fname"]);
    $midname = mysqli_real_escape_string($config,$_POST["midname"]);
    $course = mysqli_real_escape_string($config,$_POST["course"]);
    $birthplace = mysqli_real_escape_string($config,$_POST["birthplace"]);
    $mobile = mysqli_real_escape_string($config,$_POST["mobile"]);
    $sex = $_POST["sex"];
    $fathername = mysqli_real_escape_string($config,$_POST["fathername"]);
    $mname = $_POST["mname"];
    $fatherocc = mysqli_real_escape_string($config,$_POST["fatherocc"]);
    $motherocc = $_POST["motherocc"];
    $guardian = $_POST["guardian"];
    $guardianaddr = $_POST["guardianaddr"];
    $relation = $_POST["relation"];
    $grade = $_POST["grade"];
    $address = $_POST["address"];
    $religion = $_POST["religion"];
    $year = $_POST["year"];

    $stmt = $config->prepare("UPDATE `enrollies` SET `surname`= ?,`firstname`= ?,`middlename`= ?,`course`= ?,`birth_place`= ?,`contact_number`= ?,`sex`= ?,`fathersname`= ?,`mothersname`= ?,`father_occupation`= ?,`mother_occupation`= ?,`guardian`= ?,`guardian_addr`= ?,`guardian_relation`= ?,`grade_level`= ?,`addr`= ?,`schoolyear` = ? ,`religion`= ? WHERE id = ?");
    $stmt->bind_param("ssssssssssssssssssi",
        $sname,
        $fname,
        $midname,
        $course,
        $birthplace,
        $mobile,
        $sex,
        $fathername,
        $mname,
        $fatherocc,
        $motherocc,
        $guardian,
        $guardianaddr,
        $relation,
        $grade,
        $address,
        $year,
        $religion,
        $id
    );
    $stmt->execute();
    if($stmt == true){
      create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Edit','Edited A Student')");
    header("location: ../dashboard.php");
    exit();
    }else{
    header("location: ../dashboard.php?error");
    }
    $stmt->close();
    $config->close();

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Enrollment System for Sta. Martha Educational Center">
<title>Dashboard - Update <?php echo $firstname; ?></title>
<?php include "header/style-cdn.php"; ?>
</head>
<body id="page-top">
<?php include_once "header/nav.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold">Updating the Data of: <?php echo $firstname; ?></h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

	<div class="row justify-content-center">
		<div class="col-md-12">
		<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="process_data">
  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Surname</label>
      <input type="text" name="sname" class="form-control" id="sname" value="<?php echo $surname; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Firstname</label>
      <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $firstname; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Middlename</label>
      <input type="text" name="midname" class="form-control" id="midname" value="<?php echo $middlename; ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Select Course</label>
      <select id="inputState" name="course" class="form-control" id="course">
        <?php
        $select = "SELECT * FROM course WHERE course_id = '".$key["course_id"]."'";
        $run = mysqli_query($config,$select);
        foreach ($run as $key) {
        ?>
        <option selected value="<?php echo $run["course"]; ?>"><?php echo $run["course"]; ?></option>
      <?php } ?>
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
      <input type="text" class="form-control" name="birthplace" id="birthplace"value="<?php echo $birth_place; ?>">
    </div>
  </div>

   <div class="form-group">
    <label for="inputMobile">Mobile Number</label>
    <input type="text" class="form-control" name="mobile" placeholder="+6391036305252" id="mobile" value="<?php echo $contact_number; ?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputZip">Sex</label>
      <select class="form-control" name="sex">
      <option value="<?php echo $sex; ?>" selected=""><?php echo $sex; ?></option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Fathersname</label>
      <input type="text" class="form-control" name="fathername" id="fathername"value="<?php echo $fathersname; ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Mothersname</label>
      <input type="text" class="form-control" name="mname" id="mname" value="<?php echo $mothersname; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Father Occupation</label>
      <input type="text" class="form-control" name="fatherocc" id="fatherocc"
      value="<?php echo $father_occupation; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Mother Occupation</label>
      <input type="text" class="form-control" name="motherocc" id="motherocc"
      value="<?php echo $mother_occupation; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Guardian</label>
      <input type="text" class="form-control" name="guardian" id="guardian"
      value="<?php echo $guardian; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Guardian Address</label>
      <input type="text" class="form-control" name="guardianaddr" id="guardianaddr" value="<?php echo $guardian_addr; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputrelationship">Guardian Relationship</label>
      <input type="text" class="form-control" name="relation" id="relation" value="<?php echo $guardian_relation; ?>">
    </div>
     <div class="form-group col-md-6">
      <label for="inputState">Grade</label>
      <select id="inputState" class="form-control" name="grade" id="grade">
        <option selected value="<?php echo $grade_level; ?>"><?php echo $grade_level; ?></option>
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
      <input type="text" class="form-control" name="address" id="address"
      value="<?php echo $addr; ?>"
      >
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Religion</label>
      <input type="text" class="form-control" name="religion" id="religion"
      value="<?php echo $religion; ?>">
    </div>
  </div>
   <div class="form-group">
      <label for="inputState">School Year</label>
      <select id="inputState" class="form-control" name="year" id="year">
        <option value="<?php echo $year; ?>" selected=""><?php echo $year ?></option>
       <?php
        $select = "SELECT * FROM schoolyear";
        $run = mysqli_query($config,$select);
        foreach ($run as $key) {
            echo "<option value='".$key["schoolyear"]."'>".$key["schoolyear"]."</option>";
        }
        ?>
      </select>
    </div>
  <button type="submit" class="btn btn-outline-info" name="update" id="submit">Update Enrollment Data</button>
</form>
		</div>
	</div>

</table>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $("#dataTable").DataTable();
    });
</script>
<?php include_once "header/footer.php"; ?>
