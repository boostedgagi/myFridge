<?php

class IngredientControl extends Ingredient{
    protected function makeNewRecipeBase(int $recipeID,int $grocerieID,int $amount):void
    {
        $sendRequest = $this->connect()->prepare('call makeNewRecipe(?,?,?);');

        if (!$sendRequest->execute(array($recipeID,$grocerieID,$amount))) {
            $sendRequest = null;
            header("location: ../newRecipe.php?error=ingredient_insert_failed");
            exit();
        }
//        return $this->connect()->lastInsertId();
    }

}
