<?php

class EmailVerification extends Database
{
    protected function activateAccount($email,$verificationCode){

        $verifyRegisteredUser = $this->connect()->prepare('call verifyRegisteredUser(?,?);');

        if (!$verifyRegisteredUser->execute(array($email,$verificationCode))) {
            $verifyRegisteredUser = null;
            header("location: ../index.php?error=verification_failed");
            exit();
        }
    }

    protected function checkForExistingActivation($email):bool
    {
        $check = $this->connect()->prepare('select verifyingCode from users where email=?');
        $check->execute(array($email));

        $codeCheck = $check->fetch();
        if($codeCheck!==0){
            return true;
        }
        return false;
    }

    protected function checkForInvalidActivationData($email,$verificationCode):bool
    {
        $check = $this->connect()->prepare('select verifyingCode from users where email=? and verifyingCode=?');
        $check->execute(array($email,$verificationCode));

        $codeCheck = $check->fetch();
        if($codeCheck){
            return true;
        }
        return false;
    }
}
