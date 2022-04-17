<?php

class Roommates extends Database{
    protected function sendRequestToARoommateBase($senderEmail,$receiverEmail)
    {
        $sendRequest = $this->connect()->prepare('call sendRoommateRequest(?,?);');

        if (!$sendRequest->execute(array($senderEmail,$receiverEmail))) {
            $sendRequest = null;
            header("location: ../roommates.php?error=request_sending_failed");
            exit();
        }
    }

}
