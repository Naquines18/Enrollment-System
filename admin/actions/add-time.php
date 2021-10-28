<?php
session_start();
include_once("../initialize/config.php");
if (isset($_POST["add"])) {
	$oras = mysqli_real_escape_string($config,$_POST["oras"]);
  $created = date("Y-m-d H:i:s");

	$stmt = $config->prepare("INSERT INTO oras (oras,created) VALUES (?, ?)");
	$stmt->bind_param("ss",$oras,$created);
	$stmt->execute();
	if ($stmt == true) {

		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Hour')");

		header("location: ../schedules.php?success=You Successfully Add a Data");
	}elseif($stmt == false){
		header("location: ../schedules.php?error=Error Occured When You Want To Add a School Year");
	}
	$stmt->close();
	$config->close();
}
