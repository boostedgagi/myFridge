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
            header("location:../index.php?error=empty_entries");
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
}