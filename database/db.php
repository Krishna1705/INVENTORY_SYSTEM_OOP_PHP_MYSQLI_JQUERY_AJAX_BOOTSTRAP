<?php

class Database{
    private $con;

    public function connect(){
        include_once("constants.php");

        $this->con=new Mysqli(HOST,USER,PASS,DB);
        if($this->con){
             
            // echo "connection successful";
             return $this->con;
           
        }else{
            echo "database connection error";
        }
    }//end of function

}//end of class

//$obj=new Database();
//$obj-> connect();



?>