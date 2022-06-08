<?php

class EditUser extends Database{
    protected function updateUserData($firstName,$lastName,$phoneNumber,$profPicPath,$email):void{
        $query = "call updateUserData(?,?,?,?,?)";
        $insertGrocerie = $this->connect()->prepare($query);

        if(!$insertGrocerie->execute(array($firstName,$lastName,$phoneNumber,$profPicPath,$email))){
            $insertGrocerie=null;
            header("location: ../user.php?error=editing_your_data_gone_wrong");
            exit();
        }
    }

}
