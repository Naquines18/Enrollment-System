<?php
session_start();
include '../initialize/config.php';



$sched = $_POST["sched"];
$created = date("Y-m-d H:i:s");

$stmt = $config->prepare("INSERT INTO schedule (schedule,created) VALUES(?,?)");
$stmt->bind_param("ss",$sched,$created);
$stmt->execute();
create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Schedule')");
$stmt->close();
$config->close();
