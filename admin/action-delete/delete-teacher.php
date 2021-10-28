<?php
session_start();
include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    echo $id;

    $delete = mysqli_query($config,"DELETE FROM teachers WHERE id=$id");
    switch ($delete) {
        case 'Success';
            if($delete == true){
                create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Delete','Remove A Teacher')");
                header("location: ../teacher.php");
            }
            break;
        
        default:
        if($delete == false){
                header("location: ../teacher.php");
            }
            break;
    }

}