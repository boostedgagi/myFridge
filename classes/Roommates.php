<?php

class Roommates extends Database
{
    protected function sendRequestToARoommateBase($senderEmail, $receiverEmail)
    {
        $sendRequest = $this->connect()->prepare('call sendRoommateRequest(?,?);');

        if (!$sendRequest->execute(array($senderEmail, $receiverEmail))) {
            $sendRequest = null;
            header("location: ../roommates.php?error=request_sending_failed");
            exit();
        }
    }

    protected function checkIfSameRoommateRequestAlreadyExist($senderEmail, $receiverEmail): bool
    {

        $query = 'select count(fr.senderID) as counter 
            from friendrequest fr 
            where fr.receiverID=(select u.userID from users u where u.email=?)
            and fr.senderID=(select u.userID from users u where u.email=?)';
        $checkForExistingRoommateRequest = $this->connect()->prepare($query);

        $checkForExistingRoommateRequest->execute(array($receiverEmail, $senderEmail));

        $result = $checkForExistingRoommateRequest->fetch();
        //echo $result;
        if ($result["counter"] > 0) {
            return false;
        }
        return true;
    }

    protected function checkIfRequestIsAlreadySentToYou($senderEmail, $receiverEmail): bool
    {

        $query = 'select count(fr.frireqID) as counter 
            from friendrequest fr 
            where fr.receiverID=(select u.userID from users u where u.email=?)
            and fr.senderID=(select u.userID from users u where u.email=?);';
        $checkForExistingRoommateRequest = $this->connect()->prepare($query);

        $checkForExistingRoommateRequest->execute(array($senderEmail,$receiverEmail));

        $result = $checkForExistingRoommateRequest->fetch();
        //echo $result;
        if ($result["counter"] > 0) {
            return false;
        }
        return true;
    }


    protected function checkIfThisUserAlreadyYourRoommate($senderEmail, $receiverEmail): bool
    {
        //first query and his execution
        $query1 = '
        select count(rm.rmID) as firstCounter
        from roommates rm
        where (rm.user2_id=(select u.userID from users u where u.email = ? )
        and rm.user1_id=(select u.userID from users u where u.email = ?));';

        $checkForRoommate1 = $this->connect()->prepare($query1);
        $checkForRoommate1->execute(array($senderEmail, $receiverEmail));

        //second query and his execution
        $query2='
        select count(rm.rmID) as secondCounter
        from roommates rm
        where (rm.user1_id=(select u.userID from users u where u.email = ?)
        and rm.user2_id=(select u.userID from users u where u.email = ?));';

        $checkForRoommate2 = $this->connect()->prepare($query2);
        $checkForRoommate2->execute(array($senderEmail,$receiverEmail));

        //fetching both queries and their fetching into variables
        $result1 = $checkForRoommate1->fetch();
        $result2 = $checkForRoommate2->fetch();

        //making logic where is checked if receiver or sender has already marked their request as approved
        if ($result1["firstCounter"] == 1 || $result2["secondCounter"] == 1) {
            return false;
        }
        return true;
    }


}
