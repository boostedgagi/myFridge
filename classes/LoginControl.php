<?php

class LoginControl extends Login{

    private string $email;
    private string $password;

    public function __construct($email,$password){
        $this->email=$email;
        $this->password=$password;
    }



    public function logInUser()
    {
        if ($this->emptyEntriesForLogin() === false) {
            header("location:../index.php?error=empty_entries");
            exit();
        }
        if ($this->checkIfMailIsValid() === false) {
            header("location:../index.php?error=email_format_is_invalid");
            exit();
        }
        if($this->checkForUserAllowanceStatus()===false){
            header("location:../index.php?error=you_are_not_allowed_to_log_in");
            exit();
        }
        $this->logInUserBase($this->email, $this->password);
    }

    private function emptyEntriesForLogin(): bool
    {
        if (empty($this->email) || empty($this->password)) {
            return false;
        }
        return true;
    }

    private function checkIfMailIsValid():bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function checkForUserAllowanceStatus():bool{
        if($this->checkIfUserIsBannedFromDatabase($this->email)===false){
            return false;
        }
        return true;
    }
}