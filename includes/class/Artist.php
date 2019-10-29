<?php 

class Artist{
    private $connection;
    private $id;
    
    public function __construct($connection, $id){
     $this->connection = $connection;
     $this->id = $id;    
    }
    public function getName(){
        $query = "SELECT name FROM artists WHERE id=$this->id";
        $artistQuery = mysqli_query($this->connection, $query);
        $artist = mysqli_fetch_array($artistQuery);
        return $artist['name'];
    }
}




?>