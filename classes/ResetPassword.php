<?php

class ResetPassword extends Database
{
    protected function resetPasswordBase($pwd, $selector, $token)
    {
        $resetPasswordBase = $this->connect()->prepare('call resetPasswordWithDelete(?,?,?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        if (!$resetPasswordBase->execute(array($hashedPwd, $selector, $token))) {
            $resetPasswordBase = null;
            header("location: ../index.php?error=password_reset_failed");
            exit();
        }
    }

    protected function checkIfTokenIsValid($selector, $token, $expires):bool
    {
        $row = $this->connect()->prepare('select pwdResetToken from passwordreset where pwdResetSelector = ? and pwdResetExpiringDate >=?');
        $row->execute(array($selector, $expires));
        $result = $row->fetch();
        if ($token === $result["pwdResetToken"]) {
            return true;
        }
        return false;

    }
}