<?php

$hostname = //your host;
$username = //database username;
$password = //databse password;
$dbname = //database password;

$conn = new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection error".$conn->connect_error);
}


?>
