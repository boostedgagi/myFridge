<?php
include "../includes/constants.php";
if (isset($_POST['regsubmit'])) {
    //include "../includes/constants.php";
    $firstName = $_POST['reg-f-name'];
    $lastName = $_POST['reg-l-name'];
    $phone = $_POST['reg-phone'];
    $email = $_POST['reg-email'];
    $password = $_POST['reg-pwd'];
    $passwordRepeat = $_POST['reg-pwd-repeat'];
//$country=$_POST['reg-country'];
    $country = "";
//$city=$_POST['reg-city'];
    $city = "";

    $verifyingCode = rand(CODE_MIN,CODE_MAX);
    $file = $_FILES['reg-prof-img-path'];

    $fileName = $_FILES['reg-prof-img-path']['name'];
    $tempFileName = $_FILES['reg-prof-img-path']['tmp_name'];
    $fileError = $_FILES['reg-prof-img-path']['error'];
    $fileSize = $_FILES['reg-prof-img-path']['size'];

    include "../classes/Database.php";
    include "../classes/Register.php";
    include "../classes/RegisterControl.php";
    include "../classes/Image.php";

    $image = new Image($fileName, $tempFileName, $fileError, $fileSize,'registerUser');
    $registration = new RegisterControl($firstName, $lastName, $phone, $email, $password, $passwordRepeat, $country, $city,$image->handlePictureAndItsLocation(), $verifyingCode);

    //$registration->setProfilePicturePath($image->handlePictureAndItsLocation());
    $registration->setVerifyingCode($verifyingCode);

    $registration->registerNewUser();
    header("location: ../index.php?registered_successfully");

    $message = "Please confirm your email address on this link here: 
    http://localhost/myFridge/actions/emailAction.php?email=$email&verifyCode=$verifyingCode";

    mail($email,'Email verification',$message);
    //echo '<script>alert("Registration complete! Please confirm your email address.")</script>';

}
