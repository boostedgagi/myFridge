<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "classes/Database.php";
?>
<h1 class="text-center my-3">Roommate requests</h1>
<div class="container-lg d-flex flex-column align-items-center">


    <?php
    $initialDatabaseObjects = new Database();
    $allRequests = $initialDatabaseObjects->checkForAllRoommateRequests("");
    $counter = count($allRequests);
    if ($counter !== 0) {
        foreach ($allRequests as $request) {
            $ignored = "";
            if ($request['ignored'] == 1) {
                $ignored = "<span style='color:#f00;'>ignored</span>";
            } else if ($request['ignored'] == 0) {
                $ignored = "<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=" . $request["requestID"] . "&operation=deny&sentFrom=roommatesRequests' style='color:#f00'>Deny</a>";
            }
            echo "<div class='border-orange'><img src='" . $request['pppath'] . "' height='50px' width='50px'>" . $request["senderEmail"] . "<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=" . $request["requestID"] . "&operation=accept&sentFrom=roommatesRequests' style='color:#00f'>Accept</a>" . $ignored . "<br></div></div>";
            //echo "<img src='".$request['pppath']."' height='50px' width='50px'>".$request["senderEmail"]."<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=accept' style='color:blue'>Accept</a><a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=deny' style='color:red'>Deny</a>"."<br>";
        }
    } else {
        echo "<h4 class='text-center'>You dont have any requests</h4></div>";
    }

    include "includes/footer.php";
    ?>