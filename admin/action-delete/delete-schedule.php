<?php
session_start();

include '../initialize/config.php';

if (isset($_GET["schedule_id"])) {
	$id = $_GET["schedule_id"];
	$stmt = $config->prepare("DELETE FROM schedule WHERE schedule_id = ?");
	$stmt->bind_param("i",$id);
	$stmt->execute();
	if ($stmt == true) {
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Delete','Remove A Schedule')");
		header("location: ../schedules.php?success=Data deleted successfully!");
	}else{
		header("location: ../schedules.php?fail=Deletion of data could not be process!");
	}
	$stmt->close();
	$config->close();
}

