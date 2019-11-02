<?php 

class Song{
    private $connection;
    private $id;
    private $mySqliData;
    private $title;
    private $artistId;
    private $albumId;
    private $genre;
    private $duration;
    private $path;
    
    
    public function __construct($connection, $id){
     $this->connection = $connection;
     $this->id = $id;  
     $query = "SELECT * FROM songs WHERE id=$this->id";
     $SongQuery = mysqli_query($this->connection, $query);
     $this->mySqliData = mysqli_fetch_array($SongQuery);  
     $this->title = $this->mySqliData['title'];
     $this->id = $this->mySqliData['id'];
     $this->artistId = $this->mySqliData['artist'];
     $this->albumId = $this->mySqliData['album'];
     $this->genre = $this->mySqliData['genre'];
     $this->duration = $this->mySqliData['duration'];
     $this->path = $this->mySqliData['path'];
    }

    public function getTitle(){
        return $this->title;
    }
    public function getId(){
        return $this->id;
    }
    public function getArtist(){
        return new Artist($this->connection, $this->artistId);
    }
    public function getAlbum(){
        return new Album($this->connection, $this->albumId);
    }
    public function getPath(){
        return $this->path;
    }
    public function getDuration(){
        return $this->duration;
    }
    public function getMysqliData(){
        return $this->mySqliData;
    }
    public function getGenre(){
        return $this->genre;
    }
}




?>