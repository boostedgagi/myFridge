<?php
//session_start();
if (isset($_POST["login-submit"])) {
    $email = $_POST["login-email"];
    $pwd = $_POST["login-pwd"];

    include "../classes/Database.php";
    include "../classes/Login.php";
    include "../classes/LoginControl.php";
    include "../classes/LogEvidence.php";
    include "../classes/LogEvidenceControl.php";

    $login = new LoginControl($email, $pwd);

    $login->logInUser();
    $logEvidence = new LogEvidenceControl($email);
    $logEvidence->recordLoggedUserIntoDatabase();
    $message = "login_successful";

    if ($_SESSION["accountType"] === 'admin') {
        header("location: ../admin.php?" . $message);
    } else {
        header("location: ../index.php?" . $message);
    }
}