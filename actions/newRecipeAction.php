<?php

if (isset($_POST["submit"])) {
    session_start();
    $title = $_POST["recipeTitle"];
    $category = $_POST["recipeCategory"]; //id
    $meal = $_POST["recipeMeal"]; //id
    $time = $_POST["recipeTime"]; //id
    $userEmail = $_SESSION["userEmail"];
    $arrayOfIngredients = $_POST["name"];

//    foreach ($arrayOfIngredients as $arrayOfIngredient) {
//        echo $arrayOfIngredient." ";
//    }

    $file = $_FILES['recipePicture'];
    $fileName = $_FILES['recipePicture']['name'];
    $tempFileName = $_FILES['recipePicture']['tmp_name'];
    $fileError = $_FILES['recipePicture']['error'];
    $fileSize = $_FILES['recipePicture']['size'];

    include "../classes/Database.php";
    include "../classes/NewRecipe.php";
    include "../classes/NewRecipeControl.php";
    include "../classes/Image.php";

    $image = new Image($fileName, $tempFileName, $fileError, $fileSize,'newRecipe');

    $recipe = new NewRecipeControl($title,$category,$meal,$time,$userEmail,$image->handlePictureAndItsLocation());

    $recipe->makeNewRecipe();
    echo $recipe->()." last inserted id";

    //ovde ce ici prvo unos recepta preko poziva funkcije
    //zatim povratna vrednost ce biti last inserted id i preko njega ce se pisati u recept svi potrebni sastojci
}








