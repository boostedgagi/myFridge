<?php

$selector = $_GET["selector"];
$token = $_GET["validator"];

if (empty($selector) and empty($token)) {
    header("location: passwordRecovery.php?error=problem_occurred_with_database_entries");
    exit();
} else {
    // include "../includes/header.php";
    // include "../includes/nav.php";
    // include "../includes/footer.php";
//    if (!(ctype_xdigit($selector) !== false and ctype_xdigit($token) !== false)) {
    {?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset password</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <link rel="icon" href="../images/fridge2.png" type="image/icon type">
            <link rel="stylesheet" href="../css/passwordRecovery.css"/>

        </head>
        <body>
        <div class="container-lg">
            <form action="newPasswordAction.php" method="post" class="col-xl-4 mt-5">
                <input type="hidden" name="selector" class="form-control" value="<?php echo $selector; ?>">
                <input type="hidden" name="token" class="form-control" value="<?php echo $token; ?>">
                <input type="password" name="pwd1" class="form-control" placeholder="Enter new password"><br>
                <input type="password" name="pwd2" class="form-control" placeholder="Repeat new password"><br>
                <button name="finalResetPasswordButton" class="btn bg-orange">Reset password</button>
            </form>
        </div>
        </body>
        </html>
           
        <?php
    }

}
