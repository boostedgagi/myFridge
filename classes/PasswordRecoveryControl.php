<?php

class PasswordRecoveryControl extends PasswordRecovery{
    private string $email;
    private string $selector;
    private string $token;
    private string $expires;

    public function __construct($email, $selector, $token, $expires)
    {
        $this->email=$email;
        $this->selector=$selector;
        $this->token=$token;
        $this->expires=$expires;
    }

    public function insertToken(){
        if($this->invalidEmail($this->email)===false){
            header("location: ../passwordRecovery/passwordRecovery.php?error=invalid_email_format");
            exit();
        }if($this->checkUserExistence($this->email)===true){
            header("location: ../index.php?error=this_user_dont_exist");
            exit();
        }
        if($this->checkForToken($this->email)===false){
            $this->deleteTokenIfExist($this->email);
        }

        $this->insertTokenInDatabase(
            $this->email,
            $this->selector,
            $this->token,
            $this->expires
        );
    }

    private function invalidEmail(): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}
