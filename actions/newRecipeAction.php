<?php
$arrayOfIngredients = $_POST["name"];
foreach ($arrayOfIngredients as $arrayOfIngredient) {
    echo $arrayOfIngredient;
}
if (isset($_POST["submit"])) {
    session_start();
    $title = $_POST["recipeTitle"];
    $lastName = $_POST["recipeCategory"]; //id
    $recipeTime = $_POST["recipeTime"]; //id
    $oldPicture = $_POST["oldPicture"];
    $arrayOfIngredients = $_POST["name"];
    foreach ($arrayOfIngredients as $arrayOfIngredient) {
        echo $arrayOfIngredient;
    }
    $file = $_FILES['recipePicture'];
    $fileName = $_FILES['recipePicture']['name'];
    $tempFileName = $_FILES['recipePicture']['tmp_name'];
    $fileError = $_FILES['recipePicture']['error'];
    $fileSize = $_FILES['recipePicture']['size'];

    include "../classes/Database.php";
    include "../classes/EditUser.php";
    include "../classes/EditUserControl.php";
    include "../classes/Image.php";
}
