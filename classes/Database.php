<?php

class Database{
    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $databaseHandler = new PDO('mysql:host=localhost;dbname=recipe', $username, $password);
            return $databaseHandler;
        } catch (PDOException $error) {
            print "Error: " . $error->getMessage() . "<br>";
            die();
        }
    }

    public function getAllUsernames():array{
        $currentLoggedUser= $_SESSION["userEmail"];

        $usernames = $this->connect()->prepare("select email from users where not email = ?;");
        $usernames->execute(array($currentLoggedUser));

        $tempArray=array();
        $result = $usernames->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $item) {
            $tempItem = explode(",",$item["email"]);
            foreach ($tempItem as $temp) {
                array_push($tempArray,trim($temp));
            }
        }
        return $tempArray;
    }

    public function checkForNewRoommateRequests():array{
        $receiverEmail= $_SESSION["userEmail"];
        $query = "
            select 
	        fr.frireqID as requestID,
            u.profilePicturePath as pppath,
	        u.email as senderEmail,
            fr.requestDateTime
            from users u
            left join friendrequest fr
            on u.userID=fr.senderID
            where fr.receiverID=(select us.userID from users us where us.email=?)
            and fr.ignored=0
            ORDER BY
            fr.requestDateTime
            DESC
            limit 1;";   //ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev

        $roommateRequests = $this->connect()->prepare($query);
        $roommateRequests->execute(array($receiverEmail));

        $result = $roommateRequests->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}