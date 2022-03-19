<?php

if (isset($_GET['email']) && isset($_GET['verifyCode'])) {

    $email = $_GET['email'];
    $verCode = $_GET['verifyCode'];

    include "../classes/Database.php";
    include "../classes/EmailVerification.php";
    include "../classes/EmailVerificationControl.php";

    $verification = new EmailVerificationControl($email, $verCode);

    $verification->activateUserAccountWithChecks();
    header("location:../index.php?verification_successful");
}