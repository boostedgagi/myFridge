<?php
session_start();
if(isset($_GET["receiverEmail"])){
    $senderEmail = $_SESSION["userEmail"];
    $receiverEmail = $_GET["receiverEmail"];

    include "../classes/Database.php";
    include "../classes/Roommates.php";
    include "../classes/RoommatesControl.php";

    $sendRequest = new RoommatesControl($senderEmail,$receiverEmail);
    $sendRequest->sendRequestToARoommate();

    header("location:../roommates.php?request_sent_successfully");
}
else{
    header("location:../roommates.php?please_choose_valid_roommate_data");
}
