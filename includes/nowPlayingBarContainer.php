<?php 
$query = "SELECT id FROM songs ORDER BY rand() LIMIT 10";
$songQuery = mysqli_query($connection, $query);
$resultArray = array();
while($row = mysqli_fetch_array($songQuery)){
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>
$(document).ready(function(){
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
});

function setTrack(trackId, newPlaylist, play){
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
        console.log(data);
    });


    if(play){
        audioElement.play();
    }
}

function playSong(){
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong(){
    $(".controlButton.pause").hide();
    $(".controlButton.play").show();
    audioElement.pause();
}


</script>

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
                         <button class="controlButton play" title="play button"><img src="assets/images/icons/play.png" alt="play" onclick="playSong()"></button>
                         <button class="controlButton pause" title="pause button" style="display: none;"><img src="assets/images/icons/pause.png" onclick="pauseSong()" alt="pause"></button>
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
                 <div class="volumeBar">
                     <button class="controlButton volume" title="Volume Button">
                         <img src="assets/images/icons/volume.png" alt="volume button">
                     </button>
                     <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>
                 </div>
             </div>
      </div>