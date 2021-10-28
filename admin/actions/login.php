<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    
    $stmt = $config->prepare("SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss",$username, $password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows === 1){
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
        header("location: ../dashboard.php ");      
    }else {
        echo "<script lang='iavascript'>alert('Incorrect Username or Password')</script>";
        echo "<script lang='iavascript'>window.location.href='../index.php'</script>";
    }
    $stmt->close();
    $config->close();
  
}