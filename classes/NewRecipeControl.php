<?php

class NewRecipeControl extends NewRecipe {

    private string $title;
    private int $categoryID;
    private int $mealID;
    private int $time;
    private string $userEmail;
    private string $recipeImagePath;

    public function __construct(string $title, int $categoryID, int $mealID, int $time, string $userEmail, string $recipeImagePath)
    {
        $this->title = $title;
        $this->categoryID = $categoryID;
        $this->mealID = $mealID;
        $this->time = $time;
        $this->userEmail = $userEmail;
        $this->recipeImagePath = $recipeImagePath;
    }

    public function makeNewRecipe()
    {
        if ($this->emptyEntries() === false) {
            header("location: ../newRecipe.php?error=empty_entries");
            exit();
        }


        $this->makeNewRecipeBase($this->title, $this->categoryID, $this->mealID, $this->time, $this->userEmail, $this->recipeImagePath);

    }


    private function emptyEntries(){
        if(empty($this->title)||empty($this->categoryID)||empty($this->mealID)||empty($this->time)||empty($this->userEmail)){
            return false;
        }
        return true;
    }






}