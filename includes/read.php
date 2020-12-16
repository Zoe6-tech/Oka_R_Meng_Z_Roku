<?php
//this is debugging line
// ini_set('display_errors','On');
// ini_set('display_errors',1);


//for user 
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=UTF-8");
// $results=[
//     'test1'=>'test_value'
// ];

//1. include database and objects
#test database connection
include_once '../config/database.php';//load database coonnection
include_once '../objects/movie.php';


//2. instantiate database and movie object
//instantie database
$database=new Database();
$db_connector=$database->getConnection();

$movie=new Movie($db_connector);//movie take database connector


//3. query.movies based on different requests
  // b,c take the advantage of GET
    // When people request movies:
  if(isset($_GET['id'])){
       // b.  /movie/read.php?id=1 =>return the movie that has iD equal to 1
       $results = $movie->getMovieByID($_GET['id']);
  }elseif(isset($_GET['genre'])){
       // c.  /movie/read.php?genre=comedy ==> return all comedy movies
       //$results=$movie->getMovieByGenre($_GET['genre']);
       $results = $movie->getMovieByGenre($_GET['genre']);
  }else{
       // a.  /movie/read.php=> return all movies
       $results=$movie->getMovies();
  }

//4. return the databse in Json format

// OR echo(json_encode($results));
//remove JSON_PRETTY_PRINT after test, which data size bag
echo json_encode($results);
exit;