<?php

if(isset($_POST["newCommentSubmit"])){
    session_start();
    $comment = $_POST["comment"];
    $recipeID = $_POST["recipeID"];
    $userID = $_SESSION["userID"];

    include "../classes/Database.php";
    include "../classes/Comment.php";
    include "../classes/CommentControl.php";

    $comment = new CommentControl($comment,$recipeID,$userID);
    $comment->makeNewComment();

    header("location: ../recipe.php?recipeID=".$recipeID."&status=your_comment_is_sent_to_administrator");

}