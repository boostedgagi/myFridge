<?php

class Comment extends Database
{

    protected function makeNewCommentBase($comment, $recipeID, $userID):void
    {
        $query = "call insertComment(?,?,?)";
        $newComment = $this->connect()->prepare($query);
        if (!$newComment->execute(array($comment, $recipeID, $userID))) {
            $newComment = null;
            header("location: ../recipe.php?error=your_commenting_failed");
            exit();
        }
    }

    protected function checkForDoubleComment($userID,$recipeID):bool
    {
        $query = "select count(recipe_id) as counter from reviews where user_id=?  and recipe_id = ?";
        $check = $this->connect()->prepare($query);
        $check->execute(array($userID,$recipeID));
        $counter = $check->fetch();
        if($counter["counter"]!=0){
            return false;
        }
        return true;
    }

}