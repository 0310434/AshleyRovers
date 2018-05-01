<?php

DEFINE ('DB_USER','0310434');
DEFINE ('DB_PSWD','0310434');
DEFINE ('DB_SERVER','CSDM-WEBDEV');
DEFINE ('DB_NAME','db0310434_players');


$dbcon = mysqli_connect(DB_SERVER,DB_USER,DB_PSWD,DB_NAME);

if (!$dbcon) {
    die('error connecting to database');
}
?>