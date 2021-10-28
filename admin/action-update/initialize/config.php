<?php

define("DBSERVER", "localhost");
define("DBUSER", "root");
define("DBPASSWORD", "");
define("DBNAME", "enrollment_system");

$config = mysqli_connect(DBSERVER,DBUSER,DBPASSWORD,DBNAME);

