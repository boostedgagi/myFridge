<?php

class NewRecipe extends Database
{

    protected function makeNewRecipe($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath):int
    {
        $sendRequest = $this->connect()->prepare('call makeNewRecipe(?,?,?,?,?,?);');

        if (!$sendRequest->execute(array($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath))) {
            $sendRequest = null;
            header("location: ../fridges.php?error=new_fridge_insert_failed");
            exit();
        }
        return $this->connect()->lastInsertId();
    }

    protected function insertRecipe($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath,array $ingredients){
        $last_id = $this->makeNewRecipe($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath);
        foreach($ingredients as $ingredient){
            $insertIngredients = $this->connect()->prepare('call insertIngredient(?,?,?)');

        }
    }

}
