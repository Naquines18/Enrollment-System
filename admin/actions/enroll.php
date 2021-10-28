<?php
session_start();
include '../initialize/config.php';

if (isset($_POST["enroll"])) {
    $rand = rand(463292,839393);
    $cons = 444789;

    $student_id = $cons.$rand;
    $name = mysqli_real_escape_string($config,$_POST["name"]);
    $email = mysqli_real_escape_string($config,$_POST["email"]);
    $fname = mysqli_real_escape_string($config,$_POST["fathersname"]);
    $mname = mysqli_real_escape_string($config,$_POST["mothersname"]);
    $bday = $_POST["birthday"];
    $address = mysqli_real_escape_string($config,$_POST["address"]);
    $municipality = $_POST["municipality"];
    $baranggay = mysqli_real_escape_string($config,$_POST["baranggay"]);
    $attended = $_POST["schoolattended"];
    $strand = $_POST["strand"];
    $year = $_POST["year"];




    $stmt = $config->prepare("INSERT INTO enrollies(student_id,name,email,fathersname,mothersname,bday,addr,municipality,baranggay,attended,strand,schoolyear) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssssssss", $student_id,$name,$email,$fname,$mname,$bday,$address,$municipality,$baranggay,$attended,$strand,$year);
    $stmt->execute();



    //var_dump($stmt);
    if($stmt == true){
    $status = "enrolled";
    $stmt = $config->prepare("UPDATE usertable SET status = ? WHERE username='".$_SESSION["username"]."' LIMIT 1");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    header("location: ../dashboard.php");
    exit();
    }else{
    header("location: dashboard.php?error");
    }
    $stmt->close();
    $config->close();
}
