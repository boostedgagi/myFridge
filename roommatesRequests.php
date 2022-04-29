<?php
session_start();
include "classes/Database.php";

$initialDatabaseObjects = new Database();
$allRequests = $initialDatabaseObjects->checkForAllRoommateRequests("");

foreach ($allRequests as $request){
    $ignored="";
        if($request['ignored']==1){
            $ignored="<span style='color:#f00;'>ignored</span>";
        }
        else if($request['ignored']==0){
            $ignored="<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=deny&sentFrom=roommatesRequests' style='color:#f00'>Deny</a>";
        }
        echo "<img src='".$request['pppath']."' height='50px' width='50px'>".$request["senderEmail"]."<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=accept&sentFrom=roommatesRequests' style='color:#00f'>Accept</a>".$ignored."<br>";
        //echo "<img src='".$request['pppath']."' height='50px' width='50px'>".$request["senderEmail"]."<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=accept' style='color:blue'>Accept</a><a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=deny' style='color:red'>Deny</a>"."<br>";
}

//select
//	        fr.frireqID as requestID,
//            u.profilePicturePath as pppath,
//	        u.email as senderEmail,
//            fr.requestDateTime,
//            fr.ignored as ignored
//            from users u
//            left join friendrequest fr
//            on u.userID=fr.senderID
//            where fr.receiverID=(select us.userID from users us where us.email=?)
//            and fr.ignored=0
//            and fr.requestDateTime > DATE_SUB(NOW(), INTERVAL 24 HOUR)
//            order by fr.requestDateTime desc'





?>