<?php
// $con = mysqli_connect('localhost','root','', 'gtm-web-database', '3307');
$con = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
 ?>
