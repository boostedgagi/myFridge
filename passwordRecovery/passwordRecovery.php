<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recover password</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
<link rel="icon" href="../images/fridge2.png" type="image/icon type">
<link rel="stylesheet" href="../css/passwordRecovery.css"/>
</head>
<body>
    <div class="container-lg">
<form method="post" action="forgotPasswordAction.php" class="col-6 col-md-4 mt-5 align-items-center" name="email">
    
        <label for="forgotPwdEmail" class="h4">Email:</label>
        <input type="text" name="forgotPwdEmail" id="forgotPwdEmail" class="form-control" placeholder="Enter your email" autofocus><br>
<!--    <submit></submit>-->
    <button type="submit" name="sendRecoveryLinkSubmit" class="btn bg-orange" onclick="Validate(document.email.forgotPwdEmail)">Send recovery link</button>
</form>
</div>
</body>
</html>
