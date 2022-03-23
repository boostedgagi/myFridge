<?php

class LogEvidenceControl extends LogEvidence{
    private string $email;

    public function __construct($email)
    {
        $this->email=$email;
    }

    public function recordLoggedUserIntoDatabase(){
        if($this->checkIfMailIsValid()===false){
            header("location: ../index.php?error=mail_invalid_logevcontr");
            exit();
        }
        $this->recordUserLogIn($this->email);
    }

    private function checkIfMailIsValid():bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

}