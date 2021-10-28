<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["add"])) {
 
    $username = $_POST["username"];
    $email    = $_POST["email"];
    $profile_pic = $_POST["profile"];
    $password = $_POST["password"];
    $password = sha1($_POST["password"]);
    
    $stmt = $config->prepare("INSERT INTO admin(username,email,profile_pic,password) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss",$username,$email,$profile_pic,$password);
    $stmt->execute();
    
    
    
    //var_dump($stmt);
    if($stmt == true){
        create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added An Admin')");
    header("location: ../admin.php");
    exit();
    }else{
    header("location: dashboard.php?error");
    }
    $stmt->close();
    $config->close();
}