<?php

//session_start();
class Database
{

    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $databaseHandler = new PDO('mysql:host=localhost;port=3308;dbname=recipe', $username, $password);
            return $databaseHandler;
        } catch (PDOException $error) {
            print "Error: " . $error->getMessage() . "<br>";
            die();
        }
    }

    public function getAllUsernames(): array
    {
        $currentLoggedUser = $_SESSION["userEmail"];

        $usernames = $this->connect()->prepare("select email from users where not email = ?;");
        $usernames->execute(array($currentLoggedUser));

        $tempArray = array();
        $result = $usernames->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $item) {
            $tempItem = explode(",", $item["email"]);
            foreach ($tempItem as $temp) {
                array_push($tempArray, trim($temp));
            }
        }
        return $tempArray;
    }

    public function checkForNewRoommateRequests(): array
    {
        $receiverEmail = $_SESSION["userEmail"];
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

    public function checkForAllRoommateRequests(): array
    {
        $receiverEmail = $_SESSION["userEmail"];
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

    public function getAllFridgesForCurrentUser(): array
    {
        $userEmail = $_SESSION["userEmail"];
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

    public function rowCountOfFridges(): int
    {
        return count($this->getAllFridgesForCurrentUser());
    }

    public function getAllRoommates(): array
    {
        $userEmail = $_SESSION["userEmail"];

        $query1 = "SELECT u.email as roommateEmail,u.profilePicturePath as roommatePppath from users u 
        INNER JOIN roommates rm ON
        u.userID=rm.user2_id 
        where rm.user1_id=(select u.userID from users u where u.email=?);";

        $query2 = "SELECT u.email as roommateEmail,u.profilePicturePath as roommatePppath from users u 
        INNER JOIN roommates rm ON
        u.userID=rm.user1_id 
        where rm.user2_id=(select u.userID from users u where u.email=?);";

        $getAllRoommates1 = $this->connect()->prepare($query1);
        $getAllRoommates2 = $this->connect()->prepare($query2);
        $getAllRoommates1->execute(array($userEmail));
        $getAllRoommates2->execute(array($userEmail));
        return array_merge($getAllRoommates1->fetchAll(PDO::FETCH_ASSOC), $getAllRoommates2->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getUserData(): array
    {
        $query = "
        SELECT
            u.firstName AS firstName,
            u.lastName AS lastName,
            u.email AS email,
            u.phoneNumber AS phoneNumber,
            u.profilePicturePath as pppath
        FROM
            users u
        WHERE
            email = ?
        ";
        $userData = $this->connect()->prepare($query);
        $userData->execute(array($_SESSION['userEmail']));

        return $userData->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGroceries(): array
    {
        $query = "
        SELECT
        sGr.suggGrocID as sGrID,
        sGr.suggGrocName as sGrName,
        sGr.groceriePicturePath as sGrPicPath FROM
        suggestedgroceries sGr";

        $groceries = $this->connect()->prepare($query);
        $groceries->execute();

        return $groceries->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGrocerieUnits(): array
    {
        $query = "SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING(COLUMN_TYPE, 7, LENGTH(COLUMN_TYPE) - 8), '" . ',' . "', 1 + units.i + tens.i * 10) , '" . ',' . "', -1) as units
        FROM INFORMATION_SCHEMA.COLUMNS
        CROSS JOIN (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) units
        CROSS JOIN (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) tens
        WHERE TABLE_NAME = 'suggestedGroceries' 
        AND COLUMN_NAME = 'suggGrocUnit';";

        $units = $this->connect()->prepare($query);
        $units->execute();
        $array = array();
        foreach ($units as $unit) {
            $array[] = str_replace("'",'',$unit['units']);
        }
        return $array;
    }

    public function GrocerieAutocomplete($inpText) {
                $query="SELECT * FROM suggestedgroceries WHERE suggGrocName LIKE :grocerie";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute(['grocerie' => '%' . $inpText . '%']);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                return $result;
        
    }
}