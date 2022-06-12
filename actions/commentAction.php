<?php

if(isset($_POST["newCommentSubmit"])){
    $comment = $_POST["comment"];
    $recipeID = $_POST["recipeID"];
    $userEmail = $_SESSION["userEmail"];

    include "../classes/Database.php";
    include "../classes/Comment.php";
    include "../classes/CommentControl.php";

}