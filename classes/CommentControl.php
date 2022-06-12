<?php

class CommentControl extends Comment{

    private string $comment;
    private int $recipeID;
    private int $userID;

    public function __construct(string $comment, int $recipeID, int $userID)
    {
        $this->comment = $comment;
        $this->recipeID = $recipeID;
        $this->userID = $userID;
    }

    public function makeNewComment(){
        if($this->emptyEntries()===false){
            header("location: ../recipe.php?recipeID=$this->recipeID&error=something_is_empty_in_your_comment");
            exit();
        }
        if($this->duplicateCheck()===false){
            header("location: ../recipe.php?recipeID=$this->recipeID&error=you_already_commented_this_recipe");
            exit();
        }

        $this->makeNewCommentBase($this->comment,$this->recipeID,$this->userID);
    }

    private function emptyEntries(): bool
    {
        if(empty($this->comment)||empty($this->recipeID)||empty($this->userID)){
            return false;
        }
        return true;
    }

    private function duplicateCheck(): bool
    {
        if($this->checkForDoubleComment($this->userID,$this->recipeID)===false){
            return false;
        }
        return true;
    }

}