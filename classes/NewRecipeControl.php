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




}