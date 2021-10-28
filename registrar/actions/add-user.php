<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["add"])) {
    $profile_img = array('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRK_vh1lIMVmb4hJ15JMn6wTIeUdSy8p-YqwYuOIZ1F74bovC6x05gv0HWVl-cWjdA7EmiDm42hOr0ppXTBUgSPr9EHRViaKeBCQA&usqp=CAU&ec=45732304','https://www.w3schools.com/w3images/avatar6.png','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1Y0JRx29N9sVXjLMjZiqri_P1xpfZy0OVjXYVbmBsltvFwK-iTDYyhQCBd7hB5MX4wxZlQi9wOmc-Zt10NLGC6Jazi0ErLuDBqg&usqp=CAU&ec=45732304');
    $rand_profile = array_rand($profile_img);
    $profile = $profile_img[$rand_profile];

    $name = mysqli_real_escape_string($config,$_POST["name"]);
    $email = mysqli_real_escape_string($config,$_POST["email"]);
    $password = mysqli_real_escape_string($config,$_POST["password"]);
    $password = sha1($_POST["password"]);
    $status = "Not Enroll";
    $verified = "1";
    
    $stmt = $config->prepare("INSERT INTO registered (name,email,profile_image,password,status,verified) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $name,$email,$profile,$password,$status,$verified);
    $stmt->execute();

    if($stmt == true){

    create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Add','Added A Registered User')");

    header("location: ../user.php");
    exit();
    }else{
    header("location: user.php?error");
    }
    $stmt->close();
    $config->close();
}