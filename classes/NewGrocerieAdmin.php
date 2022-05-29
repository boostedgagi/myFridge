<?php

class NewGrocerieAdmin extends Database {
    protected function insertNewSuggestedGrocerie($grocerieName, $grocerieUnit, $groceriePicturePath){
        $query = "insert into suggestedgroceries(suggGrocName,suggGrocUnit,groceriePicturePath) values (?,?,?);";
        $insert = $this->connect()->prepare($query);
        if (!$insert->execute(array($grocerieName, $grocerieUnit, $groceriePicturePath))) {
            $insert = null;
            header("location: ../adminGroceries.php?error=insert_failed");
            exit();
        }
    }

}
