<?php

$selector = $_GET["selector"];
$token = $_GET["validator"];

if (empty($selector) and empty($token)) {
    header("location: passwordRecovery.php?error=problem_occurred_with_database_entries");
    exit();
} else {
    include "../includes/header.php";
    include "../includes/nav.php";
    include "../includes/footer.php";
//    if (!(ctype_xdigit($selector) !== false and ctype_xdigit($token) !== false)) {
    {?>
            <form action="newPasswordAction.php" method="post">
                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="password" name="pwd1" placeholder="enter new password"><br>
                <input type="password" name="pwd2" placeholder="repeat new password"><br>
                <button name="finalResetPasswordButton">Reset password</button>
            </form>
        <?php
    }

}
