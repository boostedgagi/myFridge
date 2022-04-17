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
        $usernames = $this->connect()->prepare("select email from users;");
        $usernames->execute();

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


}