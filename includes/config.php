<?php 
ob_start();
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

$connection = mysqli_connect('localhost', 'root', '', 'spoofify');

if(!$connection){
    echo "error in connecting db";
}




?>