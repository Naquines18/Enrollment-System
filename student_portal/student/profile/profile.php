<?php
define("DBSERVER", "localhost");
define("DBUSER", "root");
define("DBPASSWORD", "");
define("DBNAME", "enrollment_system");
$config = mysqli_connect(DBSERVER,DBUSER,DBPASSWORD,DBNAME);



session_start();
if(!isset($_SESSION["name"]) AND $_SESSION["name"] == false){
header("location: ../../login.php");
}


$query = mysqli_query($config,"SELECT * FROM registered WHERE name='".$_SESSION["name"]."' LIMIT 1");
while ($usertable = mysqli_fetch_assoc($query)) {
  $profile = $usertable["profile_image"];
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
<title>Student Portal - <?php
echo htmlspecialchars($_SESSION["name"]);
?>  Profile</title>
<link rel="icon" type="image/png" href="logo/logo.png">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
<script src="vendor/jquery/sweetalert.css"></script>
<script src="vendor/jquery/dataTables.bootstrap4.min.css"></script>
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery/sweetalert.min.js"></script>
<script src="vendor/jquery/jquery.dataTables.min.js"></script>
</head>
<body id="page-top">
<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
<div class="sidebar-brand-icon">
<img src="img/logo.png" width="60" height="60">
</div>
<div class="sidebar-brand-text mx-3">SMEC</div>
</a>
<hr class="sidebar-divider my-0">
<li class="nav-item">
<a class="nav-link" href="../dashboard.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../view-grade.php">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
<span>View Your Grades</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="../student.php">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
<span>Find Your Name</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="../teacher.php">
<i class="fas fa-chalkboard-teacher"></i>
<span>Teachers</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="../section.php">
<i class="fas fa-chalkboard-teacher"></i>
<span>Section</span></a>
</li>
<hr class="sidebar-divider d-none d-md-block">
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>
<ul class="navbar-nav ml-auto">
</a>
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="img-profile rounded-circle"
src="<?php echo $profile; ?>">
</a>
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
aria-labelledby="userDropdown">
<a class="dropdown-item" href="#">
<i class="fas fa-user-circle"></i>
<?php
echo htmlspecialchars($_SESSION["name"]);
?>
</a>
<?php
$query = mysqli_query($config,"SELECT status FROM enrollies WHERE name='".$_SESSION["name"]."' LIMIT 1");
while ($row = mysqli_fetch_assoc($query)) {
    $status = $row["status"];

    if ($status == "Pending") {
    echo "<a class='dropdown-item' href='#'>
       Enroll Now
      </a>";
  }else{
    echo "<a class='dropdown-item' href='profile/profile.php'>
      <i class='fas fa-user-circle'></i>
       Profile
      </a>";
    }
  }
?>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="../logout.php">
<i class="fas fa-sign-out-alt"></i>
 Logout
</a>
</div>
</li>
</ul>
</nav>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<!---========================================================================-->
<?php
$query = mysqli_query($config,"SELECT * FROM registered WHERE name='".$_SESSION["name"]."'");
while ($registered = mysqli_fetch_assoc($query)) {
  $name = $registered["name"];
  $email = $registered["email"];
  $profile = $registered["profile_image"];
}

$query = mysqli_query($config,"SELECT * FROM enrollies WHERE name='".$_SESSION["name"]."'");
while ($enrollies = mysqli_fetch_assoc($query)) {
  $surname = $enrollies["surname"];
  $firstname = $enrollies["firstname"];
  $middlename = $enrollies["middlename"];
  $birth_place = $enrollies["birth_place"];
  $contact_number = $enrollies["contact_number"];
  $fathersname = $enrollies["fathersname"];
  $mothersname = $enrollies["mothersname"];
  $addr = $enrollies["addr"];
  $religion = $enrollies["religion"];
  $sex = $enrollies["sex"];
  $course = $enrollies["course"];
  $guardian = $enrollies["guardian"];
  $status = $enrollies["status"];

}
?>
<!---========================================================================-->


<!---===================================PROFILE CARD=====================================-->
  <div class="container">
    <div class="main-body">
          <div class="row gutters-sm mt-2">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo $profile; ?>" width="150">
                    <div class="mt-3">
                      <h4><?php echo $name; ?></h4>
                      <p class="text-secondary mb-1"><?php echo $religion; ?></p>
                      <p class="text-muted font-size-sm"><?php echo $birth_place; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@SMEC</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">Sta.MarthaEducCenter</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo ''.$firstname.' '.$middlename.' '.$surname.''; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $contact_number; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $addr; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Father's Fullname</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $fathersname; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mother's Fullname</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?php echo $mothersname; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sex; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Guardian's Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $guardian; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Enrollment Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <span class="badge badge-primary"><?php echo $status; ?></span>
                    </div>
                  </div>
                </div>
              </div>
<!---===================================END PROFILE CARD=====================================-->
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
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
