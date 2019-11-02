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
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
        e.preventDefault();
    })

    //Mouse Control
    $(".playbackBar .progressBar").mousedown(function(){
        mouseDown = true;
    });
    $(".playbackBar .progressBar").mousemove(function(e){
        if(mouseDown == true){
            timeFromOffset(e, this);
        }
    });
    $(".playbackBar .progressBar").mouseup(function(e){
        timeFromOffset(e, this);
    });
    
    //Volume Control
    $(".volumeBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e) {
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			audioElement.audio.volume = percentage;
		}
	});

    $(document).mouseup(function(){
        mouseDown = false;
    });




});

function timeFromOffset(mouse, progressBar){
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function prevSong(){
    if(currentIndex == 0){
        //audioElement.audio.currentTime >= 3 || currentIndex == 0
        audioElement.setTime(0);
    }
    else{
        currentIndex = currentIndex - 1;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function setShuffle(){
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);


    if(shuffle == true){
        //Randomize Playlist
        shuffleArray(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
    else{
        //Shuffle Deactivated
        //Go to regular Playlist
        currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}


function setMute(){
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
    $(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
}

function nextSong() {
    if(repeat == true){
        audioElement.setTime(0);
        playSong();
        return;
    }
	if(currentIndex == currentPlaylist.length - 1) {
		currentIndex = 0;
	}
	else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat(){
    repeat = !repeat;
    var imageName;
    if(repeat){
        imageName = "repeat-active.png";
    }
    else{
        imageName = "repeat.png";
    }
    $(".controlButton.repeat img").attr("src", "assets/images/icons/" + imageName);
}

function setTrack(trackId, newPlaylist, play){

    if(newPlaylist != currentPlaylist){
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice(); //SLICE NOT SPLICE(MISTAKE)
        shuffleArray(shufflePlaylist);
    }
    if(shuffle == true){
        currentIndex = shufflePlaylist.indexOf(trackId);
    }
    else{
        currentIndex = currentPlaylist.indexOf(trackId);
    }

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
        //IMPORTANT REGARDING PLAY NEXT SONG 
        if(play == true){
            playSong();
        } 
        //REMEMBER FOREVER
    });

    if(play == true) {
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
                         <button class="controlButton shuffle" onclick="setShuffle()" title="shuffle button"><img src="assets/images/icons/shuffle.png" alt="shuffle"></button>
                         <button class="controlButton previous" onclick="prevSong()" title="previous button"><img src="assets/images/icons/previous.png" alt="previous"></button>
                         <button class="controlButton play" title="play button" onclick="playSong()"><img src="assets/images/icons/play.png" alt="play"></button>
                         <button class="controlButton pause" title="pause button" style="display: none;"><img src="assets/images/icons/pause.png" onclick="pauseSong()" alt="pause"></button>
                         <button class="controlButton next" title="next button" onclick="nextSong()"><img src="assets/images/icons/next.png" alt="next"></button>
                         <button class="controlButton repeat" onclick="setRepeat()" title="repeat button"><img src="assets/images/icons/repeat.png" alt="repeat"></button>
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
                     <button class="controlButton volume" onclick="setMute()" title="Volume Button">
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