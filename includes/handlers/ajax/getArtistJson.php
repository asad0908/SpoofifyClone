<?php 
include "../../config.php";
if(isset($_POST['artistId'])){
    $artistId = $_POST['artistId'];
    $query = "SELECT * FROM artists WHERE id=$artistId";
    $artistQuery = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_array($artistQuery);
    echo json_encode($resultArray);
}

?>