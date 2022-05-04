<?php
session_start();
if(isset($_POST["fridgeName"]) and isset($_POST["newFridgeSubmit"])) {
    $currentUser= $_SESSION["userEmail"];
    $fridgeName = $_POST["fridgeName"];

    include "../classes/Database.php";
    include "../classes/InsertNewFridge.php";
    include "../classes/InsertNewFridgeControl.php";

    $fridge = new InsertNewFridgeControl($fridgeName,$currentUser);
    $fridge->insertNewFridge();

    header("location: ../fridges.php?new_fridge_successfully_inserted");

}

