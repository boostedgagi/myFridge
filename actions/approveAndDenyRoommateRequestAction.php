<?php

if (isset($_GET["requestID"]) and isset($_GET["operation"])) {
    $requestID = $_GET["requestID"];
    $operation = $_GET["operation"];

    include "../classes/Database.php";
    include "../classes/RoommateRequest.php";
    include "../classes/RoommateRequestControl.php";

    $requestStatus = new RoommateRequestControl($requestID, $operation);

    $requestStatus->acceptOrDenyRequest();

    $sentFromAllRequests = $_GET["sentFrom"];

    if (isset($sentFromAllRequests) and $sentFromAllRequests === "roommatesRequests") {
        if ($operation === "accept")
            header("location: ../roommatesRequests.php?status=you_have_new_roommate");
        else if ($operation === "deny")
            header("location: ../roommatesRequests.php?status=you_denied_request");

    }
    else {
        if ($operation === "accept")
            header("location: ../roommates.php?status=you_have_new_roommate");
        else if ($operation === "deny")
            header("location: ../roommates.php?status=you_denied_request");
    }

}







