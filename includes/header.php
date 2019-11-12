<?php 
include "includes/config.php";
include "includes/class/Artist.php";
include "includes/class/Album.php";
include "includes/class/Song.php";

if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script>userLoggedIn = '$userLoggedIn';</script>";
}
else{
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Slotify!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div id="mainContainer">

        <div id="topContainer">
            <?php include "includes/navBarContainer.php"; ?>
            
            <div id="mainViewContainer">
                <div id="mainContent">