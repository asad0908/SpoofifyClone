<?php 
include "../../config.php";
if(isset($_POST['songId'])){
    $songId = $_POST['songId'];
    $query = "SELECT * FROM songs WHERE id=$songId";
    $songQuery = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_array($songQuery);
    echo json_encode($resultArray);
}

?>