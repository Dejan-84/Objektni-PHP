<?php
//session_start();
//session_destroy();


 
class User{

    private $db_conn;
    
    
    public function __construct() {
        
    }

    public static function emptyInput($email, $password) {

        $message = '';
        $status = true;
        $response = array();

        if(empty($email)) {
            $message .= 'You did not enter email.<br>';
            $status = false;

           
        } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $message .='Email address is not valid.<br>';
            $status = false;
        }
        if (empty($password)) {
            $message .='You did not enter password.<br>';
            $status = false;
        }
       

        $response['message'] = $message;
        $response['status'] = $status;

        return $response;
    }

    
    public static function login($email, $password) {
        
        $message = '';
        $status = 1;
        $response = array();

        //$db_conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $db_conn = new Baza();

        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        
        $query = $db_conn->custom_query($sql);

       
        if(!$query) {

            //MYSQLI ERROR FOR TESTING ONLY-REMOVE LATER
            $status = 0;
            $message .=  'Error query.';
    
            $response['message'] = $message;
        }
        

        if($query->num_rows > 0){

            $row = $query->fetch_assoc();
            
            
            $hash = password_hash($row['password'],PASSWORD_DEFAULT);
          
            if (!password_verify($password,$hash)) {
                $status = 0;
                $message .= 'Wrong email or password.';
                $response['message'] = $message;
            }
            else {
                $status = 1;
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['logged_in'] =  true;
               
                $response['redirect_url'] ='wellcome.php';
               
            
            }
            
            
        }
        else{
            $status = 0;
            $message .= 'Wrong email or password.';
    
            $response['message'] = $message;
        }
        //$response['message'] = $message;
        $response['status'] = $status;

        return $response;
    }
      /*  
    public function details($sql){

        $query = $this->db_conn->query($sql);
        
        $row = $query->fetch_array();
            
        return $row;       
    }
    
    public function escape_string($value){
        
        return $this->db_conn->real_escape_string($value);
    }*/
}