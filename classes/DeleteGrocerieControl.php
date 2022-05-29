<?php

class DeleteGrocerieControl extends DeleteGrocerie {

    private int $id;

    public function __construct($id){
        $this->id=$id;
    }

    public function deleteGrocerie()
    {
        if(!empty($this->id)){
            $this->deleteGrocerieBase($this->id);
        }
        else{
            header("location: ./adminGroceries.php?error=something_failed_with_deleting");
        }
    }


}

