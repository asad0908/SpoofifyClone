<?php 
include("includes/includedFiles.php"); 
?>

<h1 class="pageHeadingBig">You Might Also Like!</h1>

<div class="gridViewContainer">
    <?php 
    
    $query = "SELECT * FROM albums ORDER BY rand() LIMIT 10";
    $albumQuery = mysqli_query($connection, $query);
    if(!$albumQuery){
        echo "ERROR OCCURED";
    }
    while($row = mysqli_fetch_array($albumQuery)){
        
        $albumArtwork = $row['artworkPath'];
        $albumTitle = $row['title'];
        $albumId = $row['id'];

        ?>
        <div class="gridViewItem">
            <span role="link" onclick="openPage('album.php?id=<?php echo $albumId; ?>')">
            <img src="<?php echo $albumArtwork; ?>" alt="Album Artwork">
            <div class="gridViewInfo">
                <?php echo $albumTitle; ?>
            </div>
            </span>
        </div>
        
        <?php 

    }

    ?>
</div>