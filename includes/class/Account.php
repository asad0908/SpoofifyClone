<?php 

class Account{
    private $errorArray;
    
    public function __construct(){
     $this->errorArray = array();    
    }
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
        $this->validateUsername($un);
        $this->validateFirstname($fn);
        $this->validateLastname($ln);
        $this->validateEmail($em, $em2);
        $this->validatePassword($pw, $pw2);
        
        if(empty($this->errorArray)){
            //insert into db
            return true;
        }
        else{
            return false;
        }
        
    }
    
    public function getError($error){
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }
    
    
    private function validateUsername($un){
        
        if(strlen($un)>20 || strlen($un)<5){
            array_push($this->errorArray, Constants::$usernameLength);
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
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailInvalid);
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