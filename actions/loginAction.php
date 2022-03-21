<?php
if (isset($_POST["login-submit"])) {
    $email = $_POST["login-email"];
    $pwd = $_POST["login-pwd"];

    include "../classes/Database.php";
    include "../classes/Login.php";
    include "../classes/LoginControl.php";

    $login = new LoginControl($email,$pwd);

    $login->logInUser();
    //if($prijavljivanje->getUserName()=='admin'){
    //header("location: ../admin.php");
    //}
    //else{
    header("location: ../index.php?error=none");
    //}
}