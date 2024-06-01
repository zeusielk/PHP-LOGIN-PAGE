<?php

$hostname = "localhost";
$username = "id22253615_root";
$password = "Dumi4878@#$";
$dbname = "id22253615_duumi";

$conn = new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection error".$conn->connect_error);
}


?>