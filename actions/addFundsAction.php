<?php
if (isset($_POST['newFundSubmit'])) {
    include "../Database.php";
    $budget = $_POST['funds'];
    $email = $_SESSION["userEmail"];
    $db = new Database();
    $result = $db->InsertBudget($email, $budget);
}
