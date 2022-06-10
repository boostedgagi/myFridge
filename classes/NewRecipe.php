<?php

class NewRecipe extends Database
{

    protected function makeNewRecipeBase($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath): void
    {

        $sendRequest = $this->connect()->prepare('call makeNewRecipe(?,?,?,?,?,?);');

        if (!$sendRequest->execute(array($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath))) {
            $sendRequest = null;
            header("location: ../fridges.php?error=new_fridge_insert_failed");
            exit();
        }

    }
    public function lastInsertedId(){
        return $this->lastId();
    }
    }
