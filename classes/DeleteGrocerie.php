<?php

class DeleteGrocerie extends Database{
    protected function deleteGrocerieBase($grocerieId){
        $query="delete from suggestedgroceries where suggGrocID = ?";
        $deleteGrocerie = $this->connect()->prepare($query);
        if(!$deleteGrocerie->execute(array($grocerieId))){
            $deleteGrocerie=null;
            header("location: ../adminGroceries.php?status=successfully_deleted");
            exit();
        }
    }


}

