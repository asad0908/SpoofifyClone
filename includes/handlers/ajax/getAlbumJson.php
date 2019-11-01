<?php 
include "../../config.php";
if(isset($_POST['albumId'])){
    $albumId = $_POST['albumId'];
    $query = "SELECT * FROM albums WHERE id=$albumId";
    $albumQuery = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_array($albumQuery);
    echo json_encode($resultArray);
}




?>