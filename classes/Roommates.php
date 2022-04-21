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

    protected function checkIfSameRoommateRequestAlreadyExist($senderEmail,$receiverEmail):bool{

        $query = 'select count(fr.senderID) as counter 
            from friendrequest fr 
            where fr.receiverID=(select u.userID from users u where u.email=?)
            and fr.senderID=(select u.userID from users u where u.email=?)';
        $checkForExistingRoommateRequest = $this->connect()->prepare($query);

        $checkForExistingRoommateRequest->execute(array($receiverEmail,$senderEmail));

        $result = $checkForExistingRoommateRequest->fetch();
        echo $result;
        if($result["counter"]>0){
            return false;
        }
        return true;
    }

}
