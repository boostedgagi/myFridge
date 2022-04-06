<?php

class Login extends Database
{
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

        if (password_verify($password, $passwordHash[0]["hashedPassword"]) === false)
        {
            $logInStatement = null;
            header("location: ../index.php?error=wrong_password");
            exit();
        }
        else if (password_verify($password, $passwordHash[0]["hashedPassword"]) === true)
        {
            $checkForVerified = $this->connect()->prepare('select verified from users where email = ? and hashedPassword = ?;');
            $checkForVerified->execute(array($email,$passwordHash[0]["hashedPassword"]));
            $check = $checkForVerified->fetchColumn();

            if ($check != 1) {
                $checkForVerified = null;
                header("location: ../index.php?error=account_is_not_validated_$check");
                exit();
            }

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
            session_start();
            $_SESSION["userEmail"] = $userdata[0]["email"];
            $_SESSION["userPassword"] = $userdata[0]["hashedPassword"];
            $_SESSION["userFirstName"] = $userdata[0]["firstName"];
            $_SESSION["userProfilePicture"] = $userdata[0]["profilePicturePath"];
            $_SESSION["accountType"] = $userdata[0]["accType"];
            $logInStatement = null;
        }
    }

    protected function checkIfUserIsBannedFromDatabase($email):bool
    {
        $checkUserStatus = $this->connect()->prepare('select count(email) as counter from usersallowedbyadmin where email=?;');
        $checkUserStatus->execute(array($email));
        $counter = $checkUserStatus->fetch();
        if($counter["counter"]==1){
            return true;
        }
        return false;
    }

}