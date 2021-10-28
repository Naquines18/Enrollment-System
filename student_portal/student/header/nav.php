<?php
$query = mysqli_query($config,"SELECT * FROM registered WHERE name='".$_SESSION["name"]."' LIMIT 1");
while ($registered = mysqli_fetch_assoc($query)) {
  $profile = $registered["profile_image"];
}

?>
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
<a class="nav-link" href="dashboard.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span>
</a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="view-grade.php">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
<span>View Your Grades</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="student.php">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
<span>Find Your Name</span></a>
</li>


<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="view-schedule.php">
<i class="fa fa-graduation-cap" aria-hidden="true"></i>
<span>View Schedule</span></a>
</li>


<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="teacher.php">
<i class="fas fa-chalkboard-teacher"></i>
<span>Teachers</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="section.php">
<i class="fas fa-chalkboard-teacher"></i>
<span>Section</span></a>
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
<img class="img-profile rounded-circle"
src="<?php echo $profile; ?>">
</a>
<!-- Dropdown - User Information -->
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

		}else{
			echo "<a class='dropdown-item' href='profile/profile.php'>
				<i class='fas fa-user-circle'></i>
				 Profile
				</a>";
		}
	}
?>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-sign-out-alt"></i>
 Logout
</a>
</div>
</li>

</ul>

</nav>
