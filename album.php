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
         foreach ($songIdArray as $songId) {
             echo $songId . "<br>";
         }
         
         ?>




        </ul>
</div>


<?php include "includes/footer.php"; ?>