<?php

if(isset($_GET['grocerieID'])){
    $grocerieID = $_GET['grocerieID'];

    include "../classes/Database.php";
    include "../classes/DeleteGrocerie.php";
    include "../classes/DeleteGrocerieControl.php";

    $deleteGrocerie = new DeleteGrocerieControl($grocerieID);
    $deleteGrocerie->deleteGrocerie();

    header("location: ../adminGroceries.php?status_successfully_deleted");


}