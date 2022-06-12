<?php
if (isset($_GET["userID"])) {
    include "../classes/Database.php";
    $db = new Database();
    $db->AllowUser($_GET["userID"]);
    header("Location: ../adminUsers.php");
}
