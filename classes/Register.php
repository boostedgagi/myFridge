<?php

class Register extends Database
{

    protected function registerUserWithQuery($firstName, $lastName, $phone, $email, $password, $country, $city, $profPicPath, $verifyCode)
    {
        $insertNewUser = $this->connect()->prepare('call insertUsers(?,?,?,?,?,?,?,?,?)');
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (!$insertNewUser->execute(array($firstName, $lastName, $phone, $email, $passwordHash, $country, $city, $profPicPath, $verifyCode))) {
            $insertNewUser = null;
            header("location: ../index.php?error_insert_failed");
            exit();
        }
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
