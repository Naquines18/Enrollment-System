<?php
session_start();
include '../initialize/config.php';


if (isset($_GET["course_id"])) {
	$id = $_GET["course_id"];

	$stmt = $config->prepare("DELETE FROM course WHERE course_id = ?");
	$stmt->bind_param("i",$id);
	$stmt->execute();
	if ($stmt == true) {
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Delete','Deleted A Course')");
		header("location: ../subject-sched.php?success=Data deleted successfully!");
	}else{
		header("location: ../subject-sched.php?fail=Deletion of data could not be process!");
	}
	$stmt->close();
	$config->close();
}