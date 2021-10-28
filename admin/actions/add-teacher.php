<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["add"])) {
  
    $name = mysqli_real_escape_string($config,$_POST["name"]);
    $email = mysqli_real_escape_string($config,$_POST["email"]);
    $position = mysqli_real_escape_string($config,$_POST["position"]);
    
    
    $stmt = $config->prepare("INSERT INTO teachers(name,email,position) VALUES(?,?,?)");
    $stmt->bind_param("sss", $name,$email,$position);
    $stmt->execute();
    //var_dump($stmt);
    if($stmt == true){
        create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Teacher')");
    header("location: ../teacher.php");
    exit();
    }else{
    header("location:..teacher.php?error");
    }
    $stmt->close();
    $config->close();
}