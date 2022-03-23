<?php
session_start();
if (!isset($_SESSION["userEmail"])) {
    header("location: index.php?error=you_are_not_logged_in");
}
