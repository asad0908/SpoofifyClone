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

echo $artist->getName() . "<br>";
echo $album->getTitle();




?>


<?php include "includes/footer.php"; ?>