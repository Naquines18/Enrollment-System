<?php
session_start();

include "../initialize/config.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    echo $id;

    $delete = mysqli_query($config,"DELETE FROM schoolyear WHERE id=$id");
    switch ($delete) {
        case 'Success';
            if($delete == true){

                create_logs($config,"INSERT INTO admin_registrar_log (`user`, `type`, `action`) VALUES ('".$_SESSION['username']."','Delete','Remove A School Year')");

                header("location: ../year.php?success= Your data could not be retrieved any more!");
            }
            break;
        
        default:
        if($delete == false){
                header("location: ../year.php?error= Could not delete a data!");
            }
            break;
    }

}