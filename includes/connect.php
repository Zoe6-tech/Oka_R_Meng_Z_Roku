<?php
class Database//定义一个类
{
    // property declaration
    private $host="localhost";
    private $db_name="db_movies";
    private $username="root";
    private $password="";

    public $conn;//1个公共属性

    public function getConnection(){//public function
        //to get database connection
        $this->conn=null;
        //$conn = null; close the connection before
        //->  call a method on an instance or access an instance property
        //=> array:what is on the left side of it will have a corresponding value of what is on the right side of it in array context. 
        $db_dsn=array(
            'host'=>$this->host,
            'dbname'=>$this->db_name,
            'charset'=>'utf8'
        );
  ////////////////code up just like code here////////////////////////////
//   $db_dsn = array( 
//     'host' => 'localhost',
//     'dbname' => 'fav_things',//database name
//     'charset' => 'utf8'//language
// );
//////////////////////////////////////////////////////////////////////////

  //may contain errors, so we use try catch
    try{
     //this two line take care of database connection
    $dsn='mysql:'.http_build_query($db_dsn,'',';');//change
    $this->conn=new PDO($dsn,$this->username, $this->password);//pass all info to PDO, save to conn,$conn is public 
    //echo "Connected database successfully"; 
    }catch(PDOException $exception){
       //hell php how i want do deal with error
       echo json_encode(
           array(
           'error'=>'database connection fail',
           'message'=>$exception->getMessage()//detail to descript error
           )
       );
       exit;
    }
    return $this->conn;
    }
}