<?php
include "../includes/constants.php";

if (isset($_POST["sendRecoveryLinkSubmit"]) and isset($_POST["forgotPwdEmail"])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $hashedToken = password_hash($token,PASSWORD_DEFAULT);
    $email = $_POST["forgotPwdEmail"];
    $url = "http://localhost/myFridge/passwordRecovery/createNewPassword.php?selector=".$selector."&validator=".$hashedToken;
    $expiringDate = date("U")+THIRTY_MINUTES_IN_SECONDS;
//    $expiringDate = date("U")+ONE_MINUTE_IN_SECONDS;

    include "../classes/Database.php";
    include "../classes/PasswordRecovery.php";
    include "../classes/PasswordRecoveryControl.php";

    $makeToken = new PasswordRecoveryControl($email,$selector,$hashedToken,$expiringDate);

    $message = "We received a password reset request, please reset it on this link here: 
    ".$url;
    $makeToken->insertToken();
    mail($email,'Password recovery',$message);

    header("location: ../index.php");
}