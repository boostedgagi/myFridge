<?php
session_start();
if(isset($_POST["newGrocerieSubmit"])){


    $grocerieName = $_POST["grocerieName"];
    $grocerieAmount = (int)$_POST["grocerieAmount"];
    $userEmail = $_SESSION["userEmail"];
    $frigdeName = $_POST["selectedFridge"];

    include "../classes/Database.php";
    include "../classes/InsertGrocerieToFridge.php";
    include "../classes/InsertGrocerieToFridgeControl.php";

    $exactGrocerie = new InsertGrocerieToFridgeControl($grocerieName,$grocerieAmount,$userEmail,$frigdeName);
    $exactGrocerie->insertGrocerie();

    header("location: ../fridges.php?status=grocerie_insert_succeeded");
}
?>
