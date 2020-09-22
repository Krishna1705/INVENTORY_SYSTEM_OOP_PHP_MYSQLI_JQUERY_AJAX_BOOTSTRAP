<?php
/*user class for account creation AND login purpose*/


class User{

    private $con;

    function __construct()
    {   
        include_once("../database/db.php");
        $db= new Database();

        $this->con= $db->connect();

        /*if($this->con){
            echo "connected";
        }else{
            echo "connection error";
        }*/


    }//end of constructor- magic function

//--------------------we will check if user is already registered or not.------------------------
    private function emailExists($email){

            
     //to protect our application from sql attack we will use prepared statements.
     //inside prepare() method we will write sql query,but here we will not pass variable inside prepare statement to prevent it from attack
     //we will pass variable inside bind_param() method
     //then we will use execute() ,method to execute our sql query & we will use die() method to get an error information.

         $pre_stmt= $this->con->prepare("SELECT id FROM user WHERE email=?");
         $pre_stmt->bind_param("s",$email);
         $pre_stmt->execute() or die($this->con->error);//mysqli error variable returns error if there is any error.
        $result= $pre_stmt->get_result();//mysqli get _result() method is used to get result

        if($result-> num_rows > 0){//here num_rows is a variable of mysqli_result method
            return 1;//here instead of 1 we can write TRUE(CONSTANTS)
        }else{
            return 0;//here instead of 1 we can write FALSE(CONSTANTS)
        }
    }
//-------------------------new user registration code-------------------------------    
    public function createUserAccount($username,$email,$password,$usertype){

        if($this->emailExists($email)){
            return "EMAIL_ALREADY_EXISTS";
        }else{
             $date= date("Y-m-d");
             $notes="";
             //we will encrypt the password with password_bcrypt algorithm
            $pass_hash=password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

            $pre_stmt = $this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) 
            VALUES (?,?,?,?,?,?,?)");
             
             $pre_stmt->bind_param("sssssss",$username,$email,$pass_hash,$usertype,$date,$date,$notes);
             $result= $pre_stmt->execute() or die($this->con->error);
             
             if($result){
                 return $this->con->insert_id;//insert_is is a mysqli_variable
             //    return "data  inserted";
             }else{
                return "SOME_ERROR";
             }
        }

    }//end of CreateUserAccount() function

//----------------------------user login code----------------------------------

public function userLogin($email,$password){
        $pre_stmt=$this->con->prepare("SELECT * FROM user WHERE email=?");
                    $pre_stmt->bind_param("s",$email);
                    $pre_stmt->execute() or die($this->con->error);
                    $result=$pre_stmt->get_result();

                    if($result->num_rows>0){
                        //$pass_verify=password_verify($password,$pass_hash);
                        $row=$result->fetch_assoc();
                        if(password_verify($password,$row['password'])){
                            session_start();
                            $_SESSION['userid']=$row['id'];
                            $_SESSION['username']=$row['username'];
                            $_SESSION['last_login ']=$row['last_login'];

                            //upadting last_login time of user when he is logging in
                      
                       //  $last_login=date("Y-m-d H:i:s A");
                         $last_login=date("Y-m-d H:i:s");
                        
                            $pre_stmt=$this->con->prepare("UPDATE user SET last_login=? WHERE email=?");
                            $pre_stmt->bind_param("ss",$last_login,$email);
                            $result=$pre_stmt->execute() or die($this->con->error);
                            if($result){
                                return "LOGGED_IN_SUCCESSFULLY";
                                //return 1;
                                return  $_SESSION['username'];
                            }else{
                               return "SOME_ERROR_LOGIN";
                              // return 0;
                            }
                        }else{
                            return "PASSWORD_NOT_MATCH";
                        }
                    }else{
                        return "EMAIL_IS_NOT_REGISTERED_YET";
                    }

     }//end of uerLogin() function

}//end of User class

//$user=new User();
//echo $user->createUserAccount("Monik","monikpatel@gmail.com","12345","Admin");
//echo $user->userLogin("monikpatel@gmail.com","12345");
?>