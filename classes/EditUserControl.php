<?php

class EditUserControl extends EditUser{

    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $profPicPath;
    private string $email;

    public function __construct(string $firstName, string $lastName, string $phoneNumber, string $profPicPath, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->profPicPath = $profPicPath;
        $this->email = $email;
    }

    public function updateUser(){
        if ($this->emptyEntries() === false) {
            header("location: ../user.php?error=no_empty_entries_allowed");
            exit();
        }
        if ($this->checkFNameLength() === false) {
            header("location: ../user.php?error=first_name_is_too_long");
            exit();
        }
        if ($this->checkLNameLength() === false) {
            header("location: ../user.php?error=last_name_is_too_long");
            exit();
        }
        if ($this->validPhoneNumber() === false) {
            header("location: ../user.php?error=phone_length_is_invalid");
            exit();
        }

        $this->updateUserBase($this->firstName,$this->lastName,$this->phoneNumber,$this->profPicPath,$this->email);
    }

    public function setProfPicPath(string $profPicPath): void
    {
        $this->profPicPath = $profPicPath;
    }

    private function emptyEntries(): bool
    {
        if(empty($this->firstName) || empty($this->lastName) || empty($this->phoneNumber)){
            return false;
        }
        return true;
    }

    private function checkFNameLength(): bool
    {
        require_once "../includes/constants.php";
        if (strlen($this->firstName) < FNAME_LENGTH) {
            return true;
        }
        return false;
    }

    private function checkLNameLength(): bool
    {
        require_once "../includes/constants.php";
        if(strlen($this->lastName) < LNAME_LENGTH) {
            return true;
        }
        return false;
    }

    private function validPhoneNumber(): bool
    {        require_once "../includes/constants.php";

        if (in_array(strlen($this->phoneNumber), PHONE_NUMBER_LENGTHS)) {
            return true;
        }
        return false;
    }
}