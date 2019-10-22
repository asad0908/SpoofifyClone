<?php 
include "includes/config.php";

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
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div id="nowPlayingBarContainer">
      <div id="nowPlayingBar">
             <div id="nowPlayingLeft">
                 <div class="content">
                     <span class="albumLink">
                         <img class="albumArtwork" src="https://static.wixstatic.com/media/35f40b_173bb8d9b17b43be8c84954447d10e3e~mv2_d_1205_1205_s_2.png/v1/fill/w_1205%2Ch_1205%2Cal_c%2Cq_90/file.jpg" alt="">
                     </span>
                     <div class="trackInfo">
                         <span class="trackName">
                             <span>Happy Birthday</span>
                         </span>
                         <span class="artistName">
                             <span>Asad Memon</span>
                         </span>
                     </div>
                 </div>
             </div>
             <div id="nowPlayingCenter">
                 <div class="content playerControls">
                     <div class="buttons">
                         <button class="controlButton shuffle" title="shuffle button"><img src="assets/images/icons/shuffle.png" alt="shuffle"></button>
                         <button class="controlButton previous" title="previous button"><img src="assets/images/icons/previous.png" alt="previous"></button>
                         <button class="controlButton play" title="play button"><img src="assets/images/icons/play.png" alt="play"></button>
                         <button class="controlButton pause" title="pause button" style="display: none;"><img src="assets/images/icons/pause.png" alt="pause"></button>
                         <button class="controlButton next" title="next button"><img src="assets/images/icons/next.png" alt="next"></button>
                         <button class="controlButton repeat" title="repeat button"><img src="assets/images/icons/repeat.png" alt="repeat"></button>
                     </div>
                     <div class="playbackBar">
                        <span class="progressTime current">0.00</span>
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>
                        <span class="progressTime remaining">0.00</span>
                     </div>
                 </div>
             </div>
             <div id="nowPlayingRight">
             </div>
      </div>
    </div>
</body>
</html>