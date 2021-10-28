<?php
session_start();
include_once("../initialize/config.php");
if (isset($_POST["add"])) {
	$year = mysqli_real_escape_string($config,$_POST["year"]);
    $time = date("Y-m-d H:i:s");
	$stmt = $config->prepare("INSERT INTO schoolyear (schoolyear,created) VALUES (?, ?)");
	$stmt->bind_param("ss",$year,$time);
	$stmt->execute();
	if ($stmt == true) {

		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A School Year')");

		header("location: ../year.php?success=You Successfully Add a Data");
	}elseif($stmt == false){
		header("location: ../year.php?error=Error Occured When You Want To Add a School Year");
	}
	$stmt->close();
	$config->close();
}