<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["add"])) {
 
    $section = $_POST["section"];

    $created = date("Y-m-d H:i:s");
    
    $stmt = $config->prepare("INSERT INTO sections(section,created) VALUES(?,?)");
    $stmt->bind_param("ss",$section,$created);
    $stmt->execute();
    
    
    
    if($stmt == true){
        create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Section')");
        header("location: ../section.php");
        exit();
    }else{
        header("location: dashboard.php?error");
    }
    $stmt->close();
    $config->close();
}