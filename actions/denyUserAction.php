<?php
if (isset($_GET["userID"])) {
    include "../classes/Database.php";
    $db = new Database();
    $db->DenyUser($_GET["userID"]);
    header("Location: ../adminUsers.php");
}
