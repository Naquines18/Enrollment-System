<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
<div class="sidebar-brand-icon">
<img src="img/logo.png" width="60" height="60">
</div>
<div class="sidebar-brand-text mx-3">SMEC</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../dashboard.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span></a>
</li>


<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../student.php">
<i class="fas fa-layer-group"></i>
<span>Enrolled</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../year.php">
<i class="fas fa-layer-group"></i>
<span>School Year</span></a>
</li>


<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../schedules.php">
<i class="fas fa-layer-group"></i>
<span>List of Schedules</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../subject-sched.php">
<i class="fas fa-layer-group"></i>
<span>Subject and Schedule</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../teacher.php">
<i class="fas fa-chalkboard-teacher"></i>
<span>List of Teachers</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="../position.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Teacher's Position</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
aria-expanded="true" aria-controls="collapsePages">
<i class="fas fa-fw fa-folder"></i>
<span>System Data</span>
</a>
<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">System Data:</h6>
<a class="collapse-item" href="grade-level.php">
<i class="fas fa-angle-up"></i>
 Grade Levels</a>
<a class="collapse-item" href="../section.php">
<i class="fas fa-angle-up"></i>
 Section</a>


<a class="collapse-item" href="../admin.php">
<i class="fas fa-angle-up"></i>
 Administrator</a>

<a class="collapse-item" href="../user.php">
<i class="fas fa-angle-up"></i>
 Registered User</a>
</div>
</div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>



<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">


</a>
<!-- Dropdown - Messages -->

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php
$query = "SELECT profile_pic FROM admin WHERE username='".$_SESSION["username"]."' LIMIT 1";
$admins = mysqli_query($config,$query);
foreach ($admins as $admin){
?>
<img class="img-profile rounded-circle"
src="<?php echo $admin["profile_pic"]; ?>">
</a>
<?php } ?>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
aria-labelledby="userDropdown">
<a class="dropdown-item" href="#">
<i class="fas fa-user-circle"></i>
<?php
echo htmlspecialchars($_SESSION["username"]);
?>
</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-sign-out-alt"></i>
 Logout
</a>
</div>
</li>
</ul>
</nav>
