<?php

class EditUserControl extends EditUser{

    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $profPicPath;
    private string $email;

    public function __construct(string $firstName, string $lastName, string $phoneNumber, string $profPicPath, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->profPicPath = $profPicPath;
        $this->email = $email;
    }


    //empty entries

    //provera slova i validnosti podataka, email se hvata na osnovu sessiona

    //povlacenje putanje za sliku i ostalo
}