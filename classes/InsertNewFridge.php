<?php

class InsertNewFridge extends Database{

    protected function insertNewFridgeBase($fridgeName, $userEmail):void
    {
        $sendRequest = $this->connect()->prepare('call insertNewFridge(?,?);');

        if (!$sendRequest->execute(array($fridgeName,$userEmail))) {
            $sendRequest = null;
            header("location: ../fridges.php?error=new_fridge_insert_failed");
            exit();
        }
    }


}
