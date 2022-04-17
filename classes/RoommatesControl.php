<?php

class RoommatesControl extends Roommates{

    private string $senderEmail;
    private string $receiverEmail;

    public function __construct($senderEmail,$receiverEmail){
        $this->senderEmail=$senderEmail;
        $this->receiverEmail=$receiverEmail;
    }

    public function sendRequestToARoommate(){
        if($this->checkMails()===false){
            header("location: ../roommates.php?error=incorrect_mail");
            exit();
        }
        if($this->checkForSelfRoommating()===false){
            header("location: ../roommates.php?error=you_cannot_send_request_to_yourself");
            exit();
        }
        $this->sendRequestToARoommateBase($this->senderEmail,$this->receiverEmail);

    }

    private function checkMails():bool{
        if (!filter_var($this->senderEmail, FILTER_VALIDATE_EMAIL) or !filter_var($this->receiverEmail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
    private function checkForSelfRoommating():bool{
        if($this->senderEmail===$this->receiverEmail){
            return false;
        }
        return true;
    }
}