<?php

class PasswordRecovery extends Database
{
    protected function insertTokenInDatabase($email, $selector, $token, $expires)
    {
        $insert = $this->connect()->prepare('call insertDataForPasswordRecovery(?,?,?,?);');
        //$hashedToken = password_hash($token, PASSWORD_DEFAULT);
        if (!$insert->execute(array($email, $selector, $token, $expires))) {
            $insert = null;
            header("location: ../passwordRecovery/passwordRecovery.php?error=password_recovery_data_failed");
            exit();
        }
    }

    protected function deleteTokenIfExist($email)
    {
        $delete = $this->connect()->prepare('call deleteTokenIfExists(?);');

        if (!$delete->execute(array($email))) {
            $insert = null;
            header("location: ../passwordRecovery/passwordRecovery.php?error=password_recovery_data_failed");
            exit();
        }
    }

    protected function checkForToken($email): bool
    {
        $check = $this->connect()->prepare('select pwdResetEmail from passwordreset where pwdResetEmail=?;');
        $check->execute(array($email));

        if ($check->fetch() !== "") {
            return false;
        }
        return true;
    }

    protected function checkUserExistence($email): bool
    {
        $searchForUser = $this->connect()->prepare('select count(email) from users where email=?;');

        $searchForUser->execute(array($email));
        $counter = $searchForUser->fetchColumn();

        if ($counter > 0) {
            return false;
        }
        return true;
    }


}
