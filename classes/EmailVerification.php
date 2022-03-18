<?php

class EmailVerification extends Database
{
    public function activateUserAccount($email,$verificationCode){

        $verifyRegisteredUser = $this->connect()->prepare('call verifyRegisteredUser(?,?);');

        if (!$verifyRegisteredUser->execute(array($email,$verificationCode))) {
            $verifyRegisteredUser = null;
            header("location: ../index.php?error=verification_failed");
            exit();
        }
    }


}
