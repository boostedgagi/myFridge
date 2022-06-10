<?php
if (isset($_POST['newFundSubmit'])) {
    session_start();
    include "../classes/Database.php";
    $budget = $_POST['funds'];
    $email = $_SESSION["userEmail"];
    $db = new Database();
    $db->InsertBudget($email, $budget);

    header("location: ../index.php");
}
