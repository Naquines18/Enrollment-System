<?php
session_start();
include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    echo $id;

    $delete = mysqli_query($config,"DELETE FROM admin WHERE id=$id");
    switch ($delete) {
        case 'Success';
            if($delete == true){
                create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Delete','Deleted An Admin')");
                header("location: ../admin.php");
            }
            break;
        
        default:
        if($delete == false){
                header("location: ../admin.php");
            }
            break;
    }

}