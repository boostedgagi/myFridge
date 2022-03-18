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
}