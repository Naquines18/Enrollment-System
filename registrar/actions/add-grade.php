<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["add"])) {
 
    $grade = $_POST["grade"];

    $created = date("Y-m-d H:i:s");
    
    $stmt = $config->prepare("INSERT INTO grade_levels(grade_level,created) VALUES(?,?)");
    $stmt->bind_param("ss",$grade,$created);
    $stmt->execute();
    
    
    
    //var_dump($stmt);
    if($stmt == true){
        create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added An Grade Level')");

    header("location: ../grade-level.php");
    exit();
    }else{
    header("location: dashboard.php?error");
    }
    $stmt->close();
    $config->close();
}