<?php
include '../initialize/config.php';

if(isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
    $email    = $_POST['email'];
    $password = sha1($_POST['new_password']);


    $stmt = $config->prepare("UPDATE registered SET password = ? WHERE email = ? LIMIT 1");
    $stmt->bind_param("ss",$password,$email);
    $stmt->execute();

    if($stmt == true){
        header("location: ../login.php?message=Password has been updated. You can now log!.");
        die();
    }else{
        header("location: ../login.php?message=Error in SQL query. Please check the query.");
        die();
    }
}