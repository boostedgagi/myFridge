<?php

class InsertNewFridgeControl extends InsertNewFridge{

    private string $fridgeName;
    private string $userEmail;

    public function __construct($fridgeName,$userEmail)
    {
        $this->fridgeName=$fridgeName;
        $this->userEmail=$userEmail;
    }

    public function insertNewFridge(): void
    {
        if($this->checkForFridgeNameLength()===false){
            header("location: ../fridges.php?error=fridge_name_is_too_long");
            exit();
        }
        if($this->invalidEmail()===false){
            header("location: ../fridges.php?error=invalid_email");
            exit();
        }

        $this->insertNewFridgeBase($this->fridgeName,$this->userEmail);
    }

    private function checkForFridgeNameLength(): bool{
        if(strlen($this->fridgeName)>30){
            return false;
        }
        return true;
    }

    private function invalidEmail(): bool
    {
        if (!filter_var($this->userEmail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

}
