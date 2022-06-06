<?php

class InsertGrocerieToFridge extends Database{

    protected function insertGrocerieBase($grocerieName,$grocerieAmount,$userEmail,$fridgeName):void{
        $query = "call insertGrocerieToFridge(?,?,?,?)";
        $insertGrocerie = $this->connect()->prepare($query);

        if(!$insertGrocerie->execute(array($grocerieName,$grocerieAmount,$userEmail,$fridgeName))){
            $insertGrocerie=null;
            header("location: ../fridges.php?error=failed_insert_of_grocerie");
            exit();
        }
    }

    protected function checkForValidGrocerie($grocerieName):bool{
        $query = "SELECT count(sg.suggGrocName) as counter FROM suggestedgroceries sg where sg.suggGrocName=?";
        $checkGrocerie = $this->connect()->prepare($query);

        $checkGrocerie->execute(array($grocerieName));
        $counter = $checkGrocerie->fetch();
        if($counter["counter"]==0){
            return false;
        }
        return true;
    }
}
