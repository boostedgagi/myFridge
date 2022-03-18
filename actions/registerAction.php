<?php
if (isset($_POST['regsubmit'])) {
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
    $verifyingCode = rand(1000000000, 9999999999);
    $file = $_FILES['reg-prof-img-path'];

    $fileName = $_FILES['reg-prof-img-path']['name'];
    $tempFileName = $_FILES['reg-prof-img-path']['tmp_name'];
    $fileError = $_FILES['reg-prof-img-path']['error'];
    $fileSize = $_FILES['reg-prof-img-path']['size'];

    include "../classes/Database.php";
    include "../classes/Register.php";
    include "../classes/RegisterControl.php";

    $registration = new RegisterControl($firstName, $lastName, $phone, $email, $password, $passwordRepeat, $country, $city, $fileName, $verifyingCode);

    $profilePicturePath = $registration->profilePictureLocation($fileName, $tempFileName, $fileError, $fileSize);
    $registration->setProfilePicturePath($profilePicturePath);

    $registration->registerNewUser();
    header("location: ../index.php?registered_successfully");

    //ovde iza uspesne registracije, ubaciti slanje aktivacionog koda

    $message = "Please confirm your email address on this link here: 
    http://localhost/myFridge/actions/emailAction.php?email=$email&verifyingCode=$verifyingCode";

    mail($email,'Email verification',$message);
    echo '<script>alert("Registration complete! Please confirm your email address.")</script>';

}
