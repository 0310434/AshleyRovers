<?php

DEFINE ('DB_USER','dbuser');
DEFINE ('DB_PSWD','Password');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','records');


$dbcon = mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);

if (!$dbcon) {
   die('error connecting to database');
   }
?>