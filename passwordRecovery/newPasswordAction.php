<?php

if(isset($_POST["finalResetPasswordButton"])){
    $selector = $_POST["selector"];
    $token = $_POST["token"];
    $pwd1=$_POST["pwd1"];
    $pwd2=$_POST["pwd2"];


    include "../classes/Database.php";
    include "../classes/ResetPassword.php";
    include "../classes/ResetPasswordControl.php";

$passwordResetStmt = new ResetPasswordControl($selector,$token,$pwd1,$pwd2);
$passwordResetStmt->resetPassword();
header("location: ../index.php?error=none");

}
