<?php

if(isset($_GET['email'])&&isset($_GET['verifyCode'])){

$email = $_GET['email'];
$verCode = $_GET['verifyCode'];

include "../classes/Database.php";
include "../classes/EmailVerification.php";

$verification = new EmailVerification($email,$verCode);
$verification->activateUserAccount($email,$verCode);
header("location:../index.php?verification_successful");

//$query = "UPDATE users SET verified=1, verifyingCode = 0 where email='".$email."' and verifyingCode='".$verCode."';";
//if(mysqli_query($conn, $query))
//header("location:../index.php?verification_successful");



}