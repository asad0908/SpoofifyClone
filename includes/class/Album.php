<?php 

class Album{
    private $connection;
    private $id;
    private $title;
    private $artistId;
    private $genre;
    private $artworkPath;
    
    public function __construct($connection, $id){
     $this->connection = $connection;
     $this->id = $id;  
     $query = "SELECT * FROM albums WHERE id=$this->id";
     $albumQuery = mysqli_query($this->connection, $query);
     $album = mysqli_fetch_array($albumQuery); 
     $this->title = $album['title']; 
     $this->artistId = $album['artist'];
     $this->genre = $album['genre']; 
     $this->artworkPath = $album['artworkPath']; 
    }
    public function getTitle(){
        return $this->title;
    }
    public function getArtist(){
        return new Artist($this->connection, $this->artistId);
    }
    public function getGenre(){
        return $this->genre;
    }
    public function getArtworkPath(){
        return $this->artworkPath;
    }
    public function getNoOfSongs(){
        $query = "SELECT id FROM songs WHERE album=$this->id";
        $songQuery = mysqli_query($this->connection, $query);
        return mysqli_num_rows($songQuery);
    }
}




?>