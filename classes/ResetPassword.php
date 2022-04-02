<?php

class ResetPassword extends Database{
    protected function resetPasswordBase($pwd,$selector,$token){
        $resetPasswordBase = $this->connect()->prepare('call resetPasswordWithoutDelete(?,?,?);');

        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        if(!$resetPasswordBase->execute(array($hashedPwd,$selector,$token))){
            $resetPasswordBase=null;
            header("location: ../ingitdex.php?error=password_reset_failed");
            exit();
        }
    }

    protected function checkIfTokenIsValid($selector,$token):bool{
        $row = $this->connect()->prepare('select * from passwordreset where pwdResetSelector = ? and pwdResetExpiringDate >= ?;');
        $row->execute(array($selector,$token));
        $row->fetch();
        $tokenBin = hex2bin($token);
        $tokenCheck = password_verify($tokenBin,$row["pwdResetToken"]);
        if(!$tokenCheck === false){
            return false;
        }
        return true;
    }












}