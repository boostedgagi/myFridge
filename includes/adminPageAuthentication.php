<?php
if (isset($_SESSION["accountType"])) {
    if ($_SESSION["accountType"] !== "admin") {
        header("location: index.php?error=access_forbidden_but_logged_in");
    }
} else {
    header("location: index.php?error=access_forbidden");
}
