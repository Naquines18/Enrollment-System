<?php
session_start();

include "../initialize/config.php";

if (isset($_POST["submit"]) && isset($_FILES['birth_cert']) && isset($_FILES['good_moral']) && isset($_FILES['report_card'])) {

    $cons = 46820;
    $num = rand(323423,423523);

    $student_id = $cons.$num;
    $name       = ucfirst(mysqli_real_escape_string($config,$_POST["name"]));
    $sname      = ucfirst(mysqli_real_escape_string($config,$_POST["sname"]));
    $fname      = ucfirst(mysqli_real_escape_string($config,$_POST["fname"]));
    $midname    = ucfirst(mysqli_real_escape_string($config,$_POST["midname"]));
    $course     = mysqli_real_escape_string($config,$_POST["course"]);
    $birthplace = ucfirst(mysqli_real_escape_string($config,$_POST["birthplace"]));
    $mobile     = mysqli_real_escape_string($config,$_POST["mobile"]);
    $sex        = ucfirst($_POST["sex"]);
    $fathername = ucwords(mysqli_real_escape_string($config,$_POST["fathername"]));
    $mname      = ucwords($_POST["mname"]);
    $fatherocc  = ucwords(mysqli_real_escape_string($config,$_POST["fatherocc"]));
    $motherocc  = ucwords($_POST["motherocc"]);
    $guardian   = ucwords($_POST["guardian"]);
    $guardianaddr = ucwords($_POST["guardianaddr"]);
    $relation   = ucfirst($_POST["relation"]);
    $grade      = ucfirst($_POST["grade"]);
    $address    = ucwords($_POST["address"]);
    $religion   = ucfirst($_POST["religion"]);
    $status     = "Pending";
    $year       = $_POST["year"];


    // IMAGES PROPERTIES
    $birth_cert  = $_FILES['birth_cert']['name'];
    $good_moral  = $_FILES['good_moral']['name'];
    $report_card = $_FILES['report_card']['name'];

    // IMAGE TEMP NAMES
    $birth_cert_name  = $_FILES['birth_cert']['tmp_name'];
    $good_moral_name  = $_FILES['good_moral']['tmp_name'];
    $report_card_name = $_FILES['report_card']['tmp_name'];


    // FILE TYPES
    // $birth_cert_type  = $_FILES['birth_cert']['type'];
    // $good_moral_type  = $_FILES['good_moral']['type'];
    // $report_card_type = $_FILES['report_card']['type'];

    

    // WHITELIST OF IMAGE ALLOWED
    //$whitelist   = ["jpeg","png","jpg","gif"];

    // if(!in_array($birth_cert_type,$whitelist)){
    //     header("location: ../dashboard.php?error_enroll=Please upload image only! On birth certificate field.");
    // }else if(!in_array($good_moral_type,$whitelist)){
    //     header("location: ../dashboard.php?error_enroll=Please upload image only! On good moral field.");
    // }else if(!in_array($report_card_type,$whitelist)){
    //     header("location: ../dashboard.php?error_enroll=Please upload image only! On report card field.");
    // }




    $insertImages = $config->prepare("INSERT INTO `data_images` (`user_id`, `birth_cert`, `good_moral`, `report_card`) VALUES (?,?,?,?) ");
    $insertImages->bind_param("ssss",$_SESSION['STUDENT_ID'],$birth_cert,$good_moral,$report_card);
    if($insertImages->execute()){

        
        move_uploaded_file($birth_cert_name,"../../../admin/data_image/birth/".$birth_cert);
      
        move_uploaded_file($good_moral_name,"../../../admin/data_image/good_moral/".$good_moral);
      

        move_uploaded_file($report_card_name,"../../../admin/data_image/cards/".$report_card);
       
       
    }


    $stmt       = $config->prepare("INSERT INTO `enrollies`(`student_id`, `name`, `surname`, `firstname`, `middlename`, `course`, `birth_place`, `contact_number`, `sex`, `fathersname`, `mothersname`, `father_occupation`, `mother_occupation`, `guardian`, `guardian_addr`, `guardian_relation`, `grade_level`, `addr`, `religion`,`schoolyear`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssssssssssssssssss",
        $student_id,
        $name,
        $sname,
        $fname,
        $midname,
        $course,
        $birthplace,
        $mobile,
        $sex,
        $fathername,
        $mname,
        $fatherocc,
        $motherocc,
        $guardian,
        $guardianaddr,
        $relation,
        $grade,
        $address,
        $religion,
        $year,
        $status
    );

    if($stmt->execute()){
        $update = $config->prepare("UPDATE `registered` SET `status` = ? WHERE `name` = ? LIMIT 1");

        $status = "Pending";

        $update->bind_param("ss",$status,$_SESSION['name']);
        if ($update->execute()) {
            header("location: ../dashboard.php");
        }
        $update->close();
        $config->close();
    }else{
        header("location: dashboard.php?error");
    }


    $stmt->close();
    $config->close();

}
