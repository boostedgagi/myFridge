<?php

if (isset($_POST["editUserSubmit"])) {
    session_start();
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNumber = $_POST["phoneNumber"];
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

    $image = new Image($fileName, $tempFileName, $fileError, $fileSize, 'updateUser');
    $editUser = new EditUserControl($firstName, $lastName, $phoneNumber, '', $email);

    if(isset($_FILES['edit-prof-img-path']) && !empty($_FILES['edit-prof-img-path']['name'])){
        $editUser->setProfPicPath($image->handlePictureAndItsLocation());
        $image->unlink($oldPicture);
    }
    else{
        $editUser->setProfPicPath($oldPicture);
    }

    $editUser->updateUser();

    header("location: ../user.php?status=successfully_updated");
}
