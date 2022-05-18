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

    public function getAllFridgesForCurrentUser():array{
        $userEmail= $_SESSION["userEmail"];
        $query = "SELECT ful.fridgeName as fridgeName,ful.email as userEmail,
        case 
        when ful.is_main_owner=1 then 'owner'
        when ful.is_main_owner=0 then 'user'
        else 'undefined'
        end as typeOfFridgeUser
        from fridgeusersall ful
        where ful.email=?;";

        $getAllFridges = $this->connect()->prepare($query);
        $getAllFridges->execute(array($userEmail));
//        if($getAllFridges->rowCount()==0){
//            $getAllFridges=null;
//            header("location: ./fridges.php?error=1");
//            exit();
//        }
        return $getAllFridges->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCountOfFridges():int{
        return count($this->getAllFridgesForCurrentUser());
    }

}