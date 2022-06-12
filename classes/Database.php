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

    protected function lastId(): int
    {
        return $this->connect()->lastInsertId();
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
            order by fr.requestDateTime desc limit 1;'; //ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev

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
            order by fr.requestDateTime desc;'; //ovde uzeti u obzir ako bude trebalo da se doda ako je korisnik ignorisao zaahtev

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
            $array[] = str_replace("'", '', $unit['units']);
        }
        return $array;
    }

    public function GrocerieAutocomplete($inpText): array
    {

        $query = "SELECT * FROM suggestedgroceries WHERE suggGrocName LIKE :grocerie";
        $getGrocerie = $this->connect()->prepare($query);
        $getGrocerie->execute(["grocerie" => '%' . $inpText . '%']);

        return $getGrocerie->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGrocerieData(): array
    {

        $query = "SELECT * FROM grocerieData WHERE email=?";
        $getGrocerie = $this->connect()->prepare($query);
        $getGrocerie->execute(array($_SESSION["userEmail"]));

        return $getGrocerie->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories(): array
    {
        $query = "SELECT categoryID,categoryName FROM categories;";
        $categories = $this->connect()->prepare($query);
        $categories->execute();

        return $categories->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMeals(): array
    {
        $query = "SELECT mealID,mealName FROM meals;";
        $meals = $this->connect()->prepare($query);
        $meals->execute();

        return $meals->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allowUserAndSeeTheirData(): array
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
    public function recipesAutocomplete($inpText)
    {
        $query = "SELECT u.recipeID as recipeID, u.category_id as category_id, u.recipeTitle as recipeTitle, u.estTimeInMinutes as estTime, u.recipeImagePath as img, m.mealName as mealName, c.categoryID as categoryID, c.categoryName as categoryName FROM recipes u, meals m, categories c 
        WHERE u.meal_id = m.mealID AND u.category_id = c.categoryID AND u.recipeTitle LIKE :recipe";
        $recipes = $this->connect()->prepare($query);
        $recipes->execute(["recipe" => '%' . $inpText . '%']);

        return $recipes->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recipeFiller($recipeID)
    {
        $query = "SELECT
        u.recipeID AS recipeID,
        u.category_id AS category_id,
        u.recipeTitle AS recipeTitle,
        u.estTimeInMinutes AS estTime,
        u.recipeImagePath AS img,
        m.mealName AS mealName,
        c.categoryID AS categoryID,
        c.categoryName AS categoryName
    FROM
        recipes u
    inner join meals m on 
    m.mealID=u.meal_id
    inner join categories c on 
    c.categoryID=u.category_id
    where u.recipeID = ?";
        $recipe = $this->connect()->prepare($query);
        $recipe->execute(array($recipeID));

        return $recipe->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWallet($user)
    {
        $query = "select wallet from users where email=?";
        $wallet = $this->connect()->prepare($query);
        $wallet->execute(array($user));

        return $wallet->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InsertBudget($email, $budget)
    {
        $query = "UPDATE users u 
        SET 
            u.wallet = u.wallet + ?
        where u.email = ?;";

        $wallet = $this->connect()->prepare($query);
        $wallet->execute(array($budget, $email));
    }

    public function ListUsers()
    {
        $query = "SELECT * FROM users WHERE accType = 'user'";

        $users = $this->connect()->prepare($query);
        $users->execute();

        return $users->fetchAll(PDO::FETCH_ASSOC);
    }

    public function IsAllowed($userID)
    {
        $query = "SELECT users.userID, allowedusers.user_id FROM allowedusers INNER JOIN users ON allowedusers.user_id = users.userID AND users.userID = ?";

        $user = $this->connect()->prepare($query);
        $user->execute(array($userID));

        if ($user->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AllowUser($userID)
    {
        $query = "INSERT INTO allowedusers(user_id) VALUES (?)";

        $allow = $this->connect()->prepare($query);
        $allow->execute(array($userID));
    }

    public function DenyUser($userID)
    {
        $query = "DELETE FROM allowedusers WHERE user_id = ?";

        $deny = $this->connect()->prepare($query);
        $deny->execute(array($userID));
    }

    public function InsertCategory($categoryName)
    {
        $query = "INSERT INTO categories(categoryName) VALUES (?)";
        $cat = $this->connect()->prepare($query);
        $cat->execute(array($categoryName));
    }

    public function deleteCategoryAction($categoryID)
    {
        $query = "DELETE FROM categories WHERE categoryID = ?";

        $deleteCat = $this->connect()->prepare($query);
        $deleteCat->execute(array($categoryID));
    }

    public function GetCategoryById($categoryID)
    {
        $query = "SELECT categoryName FROM categories WHERE categoryID = ?";
        $fill = $this->connect()->prepare($query);
        $fill->execute(array($categoryID));
        return $fill->fetchAll(PDO::FETCH_ASSOC);
    }

    public function EditCategoryById($categoryID, $newCatName)
    {
        $query = "UPDATE categories SET categoryName= ? WHERE categoryID = ?";
        $fill = $this->connect()->prepare($query);
        $fill->execute(array($newCatName, $categoryID));
    }
}
