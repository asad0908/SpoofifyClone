<?php 

class Account{
    private $connection;
    private $errorArray;
    
    public function __construct($connection){
     $this->errorArray = array();
     $this->connection = $connection;    
    }
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
        $this->validateUsername($un);
        $this->validateFirstname($fn);
        $this->validateLastname($ln);
        $this->validateEmail($em, $em2);
        $this->validatePassword($pw, $pw2);
        
        if(empty($this->errorArray)){
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
        }
        else{
            return false;
        }
        
    }

    public function login($un, $pw){
        $pw = md5($pw);
        $query = "SELECT * FROM users WHERE username='$un' && password='$pw'";
        $loginQuery = mysqli_query($this->connection, $query);
        if(!$loginQuery){
            echo "loginQueryFailed";
            return;
        }
        if(mysqli_num_rows($loginQuery) == 1){
            return true;
        }
        else{
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }
    
    public function getError($error){
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    public function insertUserDetails($un, $fn, $ln, $em, $pw){
        $encryptedPass = md5($pw);
        $profilePic = "assets/images/profile-pics/head-emerald.png";
        $date = date("Y-m-d");

        $insertUser = "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPass', '$date', '$profilePic')";

        $result = mysqli_query($this->connection, $insertUser);
        if($result){
            header("Location: index.php");
        }
    }
    
    
    private function validateUsername($un){
        
        if(strlen($un)>20 || strlen($un)<5){
            array_push($this->errorArray, Constants::$usernameLength);
            return;
        }
        $checkUsernameExists = "SELECT username FROM users WHERE username='$un'";
        $usernameExists = mysqli_query($this->connection, $checkUsernameExists);
        if(mysqli_num_rows($usernameExists) != 0){
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }

    }
    private function validateFirstname($fn){
        
        if(strlen($fn)>20 || strlen($fn)<2){
            array_push($this->errorArray, Constants::$firstnameLength);
            return;
        }

    }
    private function validateLastname($ln){
        
        if(strlen($ln)>20 || strlen($ln)<2){
            array_push($this->errorArray, Constants::$lastnameLenght);
            return;
        }

    }
    private function validateEmail($em, $em2){
        
        if($em != $em2){
            array_push($this->errorArray, Constants::$emailMatch);
            return;
        }
        $checkEmailExists = "SELECT email FROM users WHERE email='$em'";
        $emailExists = mysqli_query($this->connection, $checkEmailExists);
        if(mysqli_num_rows($emailExists) != 0){
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }
    private function validatePassword($pw, $pw2){
        if($pw != $pw2){
            array_push($this->errorArray, Constants::$passwordMatch);
            return;
        }
        if(preg_match('/[^A-Za-z0-9]/', $pw)){
            array_push($this->errorArray, Constants::$passwordAlpha);
            return;
        }
        if(strlen($pw)>25 || strlen($pw)<5){
            array_push($this->errorArray, Constants::$passwordLenght);
            return;
        }
    }


}




?>