<?php

if(isset($_POST["submitRecipe"])){
    session_start();
    $title = $_POST["recipeTitle"];
    $lastName = $_POST["recipeCategory"];//id
    $phoneNumber = $_POST["recipeMail"];//id
    $oldPicture = $_POST["oldPicture"];
    $email = $_SESSION["userEmail"];

    $file = $_FILES['edit-prof-img-path'];

    $fileName = $_FILES['edit-prof-img-path']['name'];
    $tempFileName = $_FILES['edit-prof-img-path']['tmp_name'];
    $fileError = $_FILES['edit-prof-img-path']['error'];
    $fileSize = $_FILES['edit-prof-img-path']['size'];


    include "../classes/Database.php";
    include "../classes/EditUser.php";
    include "../classes/EditUserControl.php";
    include "../classes/Image.php";







}

