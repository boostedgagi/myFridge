<?php

class EmailVerificationControl extends EmailVerification{

    private string $email;
    private int $code;

    public function __construct($email,$code){
        $this->email=$email;
        $this->code=$code;

    }

    public function activateUserAccountWithChecks(){
        if($this->checkMail($this->email)===false){
            header("location: ../index.php?error=mail_invalid");
            exit();
        }
        if($this->checkCode($this->code)===false){
            header("location: ../index.php?error=code_invalid");
            exit();
        }
        if($this->checkForExistingActivation($this->email)===false){
            header("location: ../index.php?error=account_is_already_verified");
            exit();
        }
        if($this->checkForInvalidActivationData($this->email,$this->code)===false){
            header("location: ../index.php?error=wrong_activation_data");
            exit();
        }
        $this->activateAccount($this->email,$this->code);
    }

    private function checkMail($email):bool
    {
        if($this->email!==""){
            return true;
        }
        return false;
    }

    private function checkCode($email):bool
    {
        require_once "../includes/constants.php";
        $min=CODE_MIN;
        $max=CODE_MAX;
        if($this->code>$min and $this->code<$max){
            return true;
        }
        return false;
    }


}
