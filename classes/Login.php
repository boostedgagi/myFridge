<?php

class Login extends Database{

    protected function logInUserBase($email, $password)
    {
        $logInStatement = $this->connect()->prepare('select hashedPassword from users where email=?;');

        if (!$logInStatement->execute(array($email))) {
            $logInStatement = null;
            header("location: ../index.php?error=login_failed");
            exit();
        }

        if ($logInStatement->rowCount() == 0) {
            $logInStatement = null;
            header("location: ../index.php?error=user_not_found");
            exit();
        }

        $passwordHash = $logInStatement->fetchAll(PDO::FETCH_ASSOC);

        if (password_verify($password, $passwordHash[0]["hashedPassword"]) === false) {
            $logInStatement = null;
            header("location: ../index.php?error=wrong_password");
            exit();
        }
        else if (password_verify($password, $passwordHash[0]["hashedPassword"]) === true) {
            $logInStatement = $this->connect()->prepare('select * from users where email=? and hashedPassword=?;');

            if (!$logInStatement->execute(array($email, $passwordHash[0]["hashedPassword"]))) {
                $logInStatement = null;
                header("location: ../index.php?error=login_failed");
                exit();
            }
            if ($logInStatement->rowCount() == 0) {
                $logInStatement = null;
                header("location: ../index.php?error=user_not_found");
                exit();
            }

            $userdata = $logInStatement->fetchAll(PDO::FETCH_ASSOC);

            if($userdata[0]["verified"]===1){
                session_start();
                $_SESSION["verified"] = $userdata[0]["verified"];
                $_SESSION["userFirstName"] = $userdata[0]["firstName"];
                $_SESSION["userLastName"] = $userdata[0]["lastName"];
                $_SESSION["userEmail"] = $userdata[0]["email"];
                $_SESSION["userPassword"] = $userdata[0]["hashedPassword"];
                $_SESSION["userProfilePicture"] = $userdata[0]["profilePicturePath"];
            }

            $logInStatement = null;
        }
    }
}