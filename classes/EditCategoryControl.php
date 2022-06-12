<?php

class EditCategoryControl extends EditCategory{

    private int $categoryID;
    private string $categoryName;

    public function __construct(int $categoryID, string $categoryName)
    {
        $this->categoryID = $categoryID;
        $this->categoryName = $categoryName;
    }

    public function editCategory():void{
        if($this->emptyEntries()===false){
            header("location: ../adminRecipeCategory.php?error=something_gone_wrong");
            exit();
        }
        if($this->validCatName()===false){
            header("location: ../adminRecipeCategory.php?error=why_category_name_contain_number");
            exit();
        }
        $this->editCategoryById($this->categoryID,$this->categoryName);
    }

    private function emptyEntries(): bool
    {
        if(empty($this->categoryID)||$this->categoryName){
            return false;
        }
        return true;
    }

    private function validCatName(){
        if (preg_match('~[0-9]+~', $this->categoryName)) {
            return false;
        }
        return true;
    }



}
