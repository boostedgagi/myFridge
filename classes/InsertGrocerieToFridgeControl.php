<?php

class InsertGrocerieToFridgeControl extends InsertGrocerieToFridge{

    private string $grocerieName;
    private int $grocerieAmount;
    private string $userEmail;
    private string $fridgeName;

    public function __construct(string $grocerieName, int $grocerieAmount, string $userEmail,string $fridgeName)
    {
        $this->grocerieName = $grocerieName;
        $this->grocerieAmount = $grocerieAmount;
        $this->userEmail = $userEmail;
        $this->fridgeName = $fridgeName;
    }

    public function insertGrocerie():void
    {
        if($this->checkValidLengthForGrocerieName()===false){
            header("location: ../fridges.php?error=grocerie_name_invalid");
            exit();
        }
        if($this->checkValidLengthForFridgeName()===false){
            header("location: ../fridges.php?error=fridge_name_invalid");
            exit();
        }
        if($this->checkValidAmountUnit()===false){
            header("location: ../fridges.php?error=amount_unit_invalid");
            exit();
        }
        if($this->checkForValidGrocerie($this->grocerieName)===false){
            header("location: ../fridges.php?error=this_grocerie_doesnt_exist_in_database");
            exit();
        }
        if($this->checkForSelectedFridge()===false){
            header("location: ../fridges.php?error=check_valid_fridge_or_insert_new");
            exit();
        }
        $this->insertGrocerieBase($this->grocerieName,$this->grocerieAmount,$this->userEmail,$this->fridgeName);
    }

    private function checkValidLengthForGrocerieName(): bool
    {
        if(strlen($this->grocerieName)>20){
            return false;
        }
        return true;
    }

    private function checkValidLengthForFridgeName(): bool
    {
        if(strlen($this->fridgeName)>30){
            return false;
        }
        return true;
    }
    private function checkValidAmountUnit(): bool
    {
        if($this->grocerieAmount===0 || $this->grocerieAmount<0){
            return false;
        }
        return true;
    }

    private function checkForSelectedFridge():bool{
        if($this->fridgeName==="any"){
            return false;
        }
        return true;
    }

}