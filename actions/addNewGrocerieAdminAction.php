<?php

include "../includes/constants.php";
if (isset($_POST['adminGrocerieSubmit'])) {

    $grocerieName = $_POST['grocerieName'];
    if ($_POST['grocerieUnit'] !== 'any') {
        $grocerieUnit = $_POST['grocerieUnit'];
    } else
        $grocerieUnit = "";

    $grocerieImage = $_FILES['grocerieImage'];

    $fileName = $_FILES['grocerieImage']['name'];
    $tempFileName = $_FILES['grocerieImage']['tmp_name'];
    $fileError = $_FILES['grocerieImage']['error'];
    $fileSize = $_FILES['grocerieImage']['size'];

    include "../classes/Database.php";
    include "../classes/NewGrocerieAdmin.php";
    include "../classes/NewGrocerieAdminControl.php";
    include "../classes/Image.php";

    $image = new Image($fileName, $tempFileName, $fileError, $fileSize,'adminGrocerie');

    $newGrocerie = new NewGrocerieAdminControl($grocerieName, $grocerieUnit,$image->handlePictureAndItsLocation());

    $newGrocerie->insertNewGrocerie();
    header("location: ../adminGroceries.php?status=insert_succeeded");
}
