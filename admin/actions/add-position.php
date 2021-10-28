<?php
session_start();
include_once("../initialize/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$position = mysqli_real_escape_string($config,$_POST["position"]);
    $time = date("Y-m-d H:i:s");
	$stmt = $config->prepare("INSERT INTO position (position,created) VALUES (?, ?)");
	$stmt->bind_param("ss",$position,$time);
	$stmt->execute();
	if ($stmt == true) {
		create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added An Position')");
		header("location: ../position.php");
	}
	$stmt->close();
	$config->close();
}