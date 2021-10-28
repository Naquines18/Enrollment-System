<?php
session_start();

include '../initialize/config.php';


if (isset($_POST["login"])) {
    $name     = $_POST["name"];
    $password = sha1($_POST["password"]);

    $stmt = $config->prepare("SELECT * FROM registered WHERE name = ? LIMIT 1");
    $stmt->bind_param("s",$name);
    $stmt->execute();

    $result = $stmt->get_result();


    if($result->num_rows === 1){
        $row    = $result->fetch_assoc();

        if($password != $row['password']){
            header("location: ../login.php?error=Please ensure that your password and username is match!");
            die();
        }else if($row['verified'] == 0){
            header("location: ../login.php?error=Please check your email inbox to verify your account!");
            die();
        }else{
            $_SESSION['STUDENT_ID'] = $row['id'];
            $_SESSION["name"]       = ucfirst($name);

            $addLogs = $config->prepare("INSERT INTO audit_tbl (`username`,`hash_password`) VALUES(?,?)");
            $addLogs->bind_param("ss",$row['name'],$row['password']);
            $addLogs->execute();
            
            header("location: ../student_portal/student/dashboard.php ");
        }

    }else{
        header("location: ../login.php?error=No user found both username and password");
    }
 
    $stmt->close();
    $config->close();

}else{
    header("location: ../login.php");
}
