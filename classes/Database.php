<?php
//session_start();
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


        $query = "select 
        fr.frireqID as requestID,
        fr.senderID as senderID,
        fr.receiverID as receiverID,
        fr.ignored as ignored 
        from friendrequest fr 
        left join users u ON
        fr.receiverID=u.userID
        where u.email=?
        and ignored = 0;";   //ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev

        $receiverEmail= $_SESSION["userEmail"];
        $query = 'select 
	        fr.frireqID as requestID,
            u.profilePicturePath as pppath,
	        u.email as senderEmail,
            fr.requestDateTime
            from users u
            left join friendrequest fr
            on u.userID=fr.senderID
            where fr.receiverID=(select us.userID from users us where us.email=?)
            and fr.ignored=0
            and fr.requestDateTime > DATE_SUB(NOW(), INTERVAL 24 HOUR)
            order by fr.requestDateTime desc limit 1;';//ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev

        $roommateRequests = $this->connect()->prepare($query);
        $roommateRequests->execute(array($receiverEmail));

        return $roommateRequests->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkForAllRoommateRequests():array{
        $receiverEmail= $_SESSION["userEmail"];
        $query = 'select 
	        fr.frireqID as requestID,
            u.profilePicturePath as pppath,
	        u.email as senderEmail,
            fr.requestDateTime,
            fr.ignored as ignored
            from users u
            left join friendrequest fr
            on u.userID=fr.senderID
            where fr.receiverID=(select us.userID from users us where us.email=?)
            order by fr.requestDateTime desc;';//ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev


        $roommateRequests = $this->connect()->prepare($query);
        $roommateRequests->execute(array($receiverEmail));

        return $roommateRequests->fetchAll(PDO::FETCH_ASSOC);
    }


}