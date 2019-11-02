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
        let track = JSON.parse(data);
        $(".trackName span").text(track.title);

        $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data){
            let artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
        });
        $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data){
            let album = JSON.parse(data);
            $(".albumArtwork").attr("src", album.artworkPath);
            
        });


        audioElement.setTrack(track);
    });


    if(play){
        audioElement.play();
    }
}

function playSong(){
    if(audioElement.audio.currentTime == 0){
        $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id })
    }
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
                         <img class="albumArtwork" src="" alt="">
                     </span>
                     <div class="trackInfo">
                         <span class="trackName">
                             <span></span>
                         </span>
                         <span class="artistName">
                             <span></span>
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
                        <span class="progressTime remaining"></span>
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