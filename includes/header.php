<?php 
include "includes/config.php";
include "includes/class/Artist.php";
include "includes/class/Album.php";
include "includes/class/Song.php";

if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
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
    <script src="assets/js/script.js"></script>
</head>
<body>
    <script>
	var audioElement = new Audio();
	audioElement.setTrack("assets/music/Nidarr.mp3");
	audioElement.audio.play();
    </script>
    
    <div id="mainContainer">

        <div id="topContainer">
            <?php include "includes/navBarContainer.php"; ?>
            
            <div id="mainViewContainer">
                <div id="mainContent">