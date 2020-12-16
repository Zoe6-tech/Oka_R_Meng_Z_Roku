
<?php
// movie.php has own class prepare any movie object that we want to use in API 
// interface
//ini_set('display_errors',1);
class Movie{
    private $conn;
    //if we want change name just change here
    public $movie_table='tbl_movies';
    public $genre_table='tbl_genre';
    public $movie_genre_linking_table='tbl_mov_genre';
    
    //pass exist data connecter
    public function __construct($db_connector){
        $this->conn = $db_connector;// dont need $
    }
    
    public function getMovies(){
        //TODP: this will return all movies
        //SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name FROM `tbl_movies`as m left join `tbl_mov_genre` as mg on mg.movies_id = m.movies_id left join `tbl_genre` as g on mg.genre_id = g.genre_id GROUP by m.movies_id 
        $query ='SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name ';
        $query .='FROM '.$this->movie_table.' m';
        $query .=' left join '.$this->movie_genre_linking_table.' mg on mg.movies_id = m.movies_id';
        $query .=' left join '.$this->genre_table.' g on mg.genre_id = g.genre_id';
        $query .=' GROUP by m.movies_id';
        $stmt=$this->conn->prepare($query);//statement
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getMovieByGenre($genre){
        //TODO: this will retuen moves that under give genre, maybe 7 moives under comedy
        //SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name FROM `tbl_movies`as m left join `tbl_mov_genre` as mg on mg.movies_id = m.movies_id left join `tbl_genre` as g on mg.genre_id = g.genre_id WHERE g.genre_name="action" GROUP by m.movies_id 
        $query ='SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name';
        $query .=' FROM '.$this->movie_table.'  m';
        $query .=' left join '.$this->movie_genre_linking_table.'  mg on mg.movies_id = m.movies_id';
        $query .=' left join '.$this->genre_table.'  g on mg.genre_id = g.genre_id';
        $query .=' WHERE g.genre_name LIKE "%'.$genre.'%"' ;
        $query .=' GROUP by m.movies_id';
        // echo $query;
        // exit;
        $stmt=$this->conn->prepare($query);//statement
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);

    }

    public function getMovieByID($id){
        //TODO: this will return one movie that matches its ID

        // return array(
        //     'test_message'=>'you are request movie that MATCH ID ===>'.$id
        // );

        $query ='SELECT m.*,GROUP_CONCAT(g.genre_name) as genre_name';
        $query .=' FROM '.$this->movie_table.'  m';
        $query .=' left join '.$this->movie_genre_linking_table.'  mg on mg.movies_id = m.movies_id';
        $query .=' left join '.$this->genre_table.'  g on mg.genre_id = g.genre_id';
        $query .=' WHERE m.movies_id= "'.$id.'"' ;
        $query .=' GROUP by m.movies_id';
        //make sure query can execute and containes  right query:
          // echo $query;
          //return $query;
          //exit;
        //checked! 

        //php execute the SQL query, like $runquery
        $stmt=$this->conn->prepare($query);//statement
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
        //The parameter PDO::FETCH_ASSOC tells PDO to return the result as an associative array.
    }
}



