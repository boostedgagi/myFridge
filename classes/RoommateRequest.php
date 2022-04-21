<?php
//session_start();
class RoommateRequest extends Database{
    protected function acceptRequestBase($acceptRequestWithThisID){
        $query = 'delete from friendrequest where frireqID=?;';
        $acceptRequest = $this->connect()->prepare($query);

        $acceptRequest->execute(array($acceptRequestWithThisID));
        if(!$acceptRequest){
            $acceptRequest=null;
            header("location: ../roommates.php?error=accepting_request_failed");
            exit();
        }
    }

    protected function denyRequestBase($denyRequestWithThisID){
        $query = 'UPDATE friendrequest fr SET fr.ignored = 1 WHERE fr.frireqID = ?;';
        $denyRequest = $this->connect()->prepare($query);

        $denyRequest->execute(array($denyRequestWithThisID));
        if(!$denyRequest){
            $acceptRequest=null;
            header("location: ../roommates.php?error=denying_request_failed");
            exit();
        }
    }





}