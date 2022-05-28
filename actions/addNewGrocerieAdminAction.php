<?php

include "../includes/constants.php";
if(isset($_POST['adminGrocerieSubmit'])){
    $grocerieName = $_POST['grocerieName'];
    $grocerieUnit = $_POST['grocerieUnit'];

    $grocerieImage = $_FILES['grocerieImage'];

    $fileName = $_FILES['grocerieImage']['name'];
    $tempFileName = $_FILES['grocerieImage']['tmp_name'];
    $fileError = $_FILES['grocerieImage']['error'];
    $fileSize = $_FILES['grocerieImage']['size'];

    include "../classes/Database.php";
    include "../classes/Register.php";
    include "../classes/RegisterControl.php";

    $temp = new RegisterControl();
    $profilePicturePath = $temp->uploadPictureLocation($fileName, $tempFileName, $fileError, $fileSize,2);
    $temp->setProfilePicturePath($profilePicturePath);
}
