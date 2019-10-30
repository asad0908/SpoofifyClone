<?php include "includes/header.php"; ?>
<?php 

if(isset($_GET['id'])){
    $albumId = $_GET['id'];
}
else{
    header("Location: index.php");
}
$album = new Album($connection, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="">
    </div>
    <div class="rightSection">
        <?php 
         //Display Customized Text
         if($album->getNoOfSongs() == 1 || $album->getNoOfSongs() == 0){
             $text = 'Song';
         }
         else{
             $text = 'Songs';
         }
        ?>
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNoOfSongs() . " ". $text; ?></p>
    </div>
</div>

<div class="trackListContainer">
         <ul class="trackList">

         <?php
         $songIdArray = $album->getSongIds();
         $i = 1;
         foreach ($songIdArray as $songId) {
             $albumSong = new Song($connection, $songId);
             $albumArtist = $albumSong->getArtist();
             ?>

            <li class="trackListRow">
                <div class="trackCount">
                    <img class="play" src="assets/images/icons/play-white.png" alt="play">
                    <span class="trackNumber"><?php echo $i; ?></span>
                </div>
                <div class="trackInfo">
                    <span class="trackName"><b><?php echo $albumSong->getTitle();?></b></span>
                    <span class="artistName"><?php echo $albumArtist->getName();?></span>
                </div>
                <div class="trackOptions">
                    <img src="assets/images/icons/more.png" class="optionsButton" alt="">
                </div>
                <div class="trackDuration">
                    <span class="duration"><?php echo $albumSong->getDuration(); ?></span>
                </div>
            </li>


        <?php
        $i++;
         }
         
         ?>




        </ul>
</div>


<?php include "includes/footer.php"; ?>