<?php

class EditCategory extends Database {
    protected function editCategoryById($categoryID, $newCatName):void
    {
        $query = "UPDATE categories SET categoryName= ? WHERE categoryID = ?";
        $edit = $this->connect()->prepare($query);
        if($edit->execute(array($newCatName, $categoryID))){
            $edit=null;
            header("location: ../adminRecipeCategory.php");
            exit();
        }
    }


}
