<?php

define("DBSERVER", "localhost");
define("DBUSER", "root");
define("DBPASSWORD", "");
define("DBNAME", "enrollment_system");

$config = mysqli_connect(DBSERVER,DBUSER,DBPASSWORD,DBNAME);


function create_logs($config,$query){
    $query = mysqli_query($config,$query);
    return $query;
}

