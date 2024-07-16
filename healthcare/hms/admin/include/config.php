<?php

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "root";
$mysql_database = "hms";


$mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>