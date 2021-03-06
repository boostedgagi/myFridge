<?php

class ResetPasswordControl extends ResetPassword
{
    private string $selector;
    private string $token;
    private string $pwd;
    private string $pwdRepeat;
    private string $expires;

    public function __construct($selector, $token, $pwd, $pwdRepeat, $expires)
    {
        $this->selector = $selector;
        $this->token = $token;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->expires = $expires;
    }

    public function resetPassword()
    {
        if ($this->matchingPasswords() === false) {
            header("location: createNewPassword.php?error=password_are_not_matching&selector=" . $this->selector . "&validator=" . $this->token);
            //echo "<script>alert('passwords are not matching');</script>";
            exit();
        }
        if ($this->hiddenEntriesEmpty() === false) {
            header("location: createNewPassword.php?selector=" . $this->selector . "&validator=" . $this->token);
            exit();
        }
        if ($this->emptyPasswords() === false) {
            header("location: createNewPassword.php?error=empty_password_fields&selector=" . $this->selector . "&validator=" . $this->token);
            exit();
        }
        if ($this->checkIfTokenIsValid($this->selector, $this->token, $this->expires) === false) {
            header("location: createNewPassword.php?error=token_failed&selector=" . $this->selector . "&validator=" . $this->token);
            exit();
        }
        $this->resetPasswordBase($this->pwd, $this->selector, $this->token);
    }


    private function matchingPasswords(): bool
    {
        if ($this->pwd === $this->pwdRepeat) {
            return true;
        }
        return false;
    }

    private function hiddenEntriesEmpty(): bool
    {
        if (!empty($this->token) and !empty($this->selector)) {
            return true;
        }
        return false;
    }

    private function emptyPasswords(): bool
    {
        if (empty($this->pwd) or empty($this->pwdRepeat)) {
            if(empty($this->pwd) and empty($this->pwdRepeat)){
                return false;
            }
        }
        return true;
    }
}