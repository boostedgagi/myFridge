<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";

include "classes/Database.php";
$dbObj1 = new Database();
$usernamesListForAutocomplete = $dbObj1->getAllUsernames();

$dbObj2 = new Database();
$newRoommateRequests =$dbObj2->checkForNewRoommateRequests(" limit 1");



foreach ($newRoommateRequests as $request){
    echo "Your newest roommate request!<br>";
    echo "<img src='".$request['pppath']."' height='50px' width='50px'>".$request["senderEmail"]."<a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=accept' style='color:blue'>Accept</a><a href='actions/approveAndDenyRoommateRequestAction.php?requestID=".$request["requestID"]."&operation=deny' style='color:red'>Deny</a>"."<br>";
}
echo "<div class='d-flex justify-content-center'><a href='roommatesRequests.php' class='btn bg-orange'>Check all requests</a></div>";

?>
    <h3 class="text-center my-3">Add your roommate, and cook together with him!</h3>
    <!--riki ovo ces
    ovde ti da menjas i da trpas sve na sredinu, ja sam stavio minimalmo stvari koje su mi potrebne za izradu funkcionalnosti-->

    <div id="roommateSearch" class="d-flex justify-content-center my-3">
        <input type="email" id="roommateEmailIInput" onkeyup="showResults(this.value)">
        <button type="submit" onclick="sendToActionPage()">
            <img src="images/roommateSearchIcon.png" height="32" width="32" border="0px">
        </button>
    </div>
    <div id="resultDiv" class="text-center mt-3">

    </div>
    <!--script src="js/roommates.js"-->
    <script>

        let autocompleteArray = JSON.parse('<?php echo json_encode($usernamesListForAutocomplete);?>');
        console.log(autocompleteArray);

        function autocompleteMatch(input) {
            if (input === '') {
                return [];
            }
            let reg = new RegExp(input)
            return autocompleteArray.filter(function (term) {
                if (term.match(reg)) {
                    return term;
                }
            });
        }

        function showResults(val) {
            let result = document.getElementById("resultDiv");
            result.innerHTML = '';
            let list = '';
            let terms = autocompleteMatch(val);
            let i=0;
            list+='';
            for (i; i < terms.length; i++) {
                //actions/addnewroommateaction.php?receiverEmail='+terms[i]+' OVO JE BILO U href-u
                list += '<li class="my-2">Click here<span><b> ' + terms[i] + '</b><span></li>';
            }
            result.innerHTML = '<ul id="resultList">' + list + '</ul>';

            //Upisivanje email adrese u polje za dodavanje roomate na klik na mejl

                const mail = document.querySelectorAll("li>span");
                const input = document.querySelector("#roommateEmailIInput");
                const buttonImg = document.querySelector("button>img");
                mail.forEach(mail => {
                    mail.addEventListener("click", (e)=> {
                        input.value = e.target.innerHTML.toString();

                        buttonImg.src = "images/add-user.png";
                    });
                });
                if(input.value === "") {
                    buttonImg.src = "images/roommateSearchIcon.png";
                }
        }
            function sendToActionPage(){
            var email = document.getElementById('roommateEmailIInput').value;
            window.location='actions/addnewroommateaction.php?receiverEmail='+email+'';
        }
    </script>

    <div>
        <ul class="d-flex align-items-center flex-column" id="roomateList">
        <?php
        $dbObj3 = new Database();
        foreach ($dbObj3->getAllRoommates() as $actualRoommate){
            echo "<li class='my-2 border-orange rounded-2 p-2 d-flex justify-content-between'><img src='".$actualRoommate['roommatePppath']."' height='50px' width='50px'><span class='align-self-center'>".$actualRoommate["roommateEmail"]."</span></li>";
        }
        ?>
        </ul>
    </div>
<?php
include "includes/footer.php";
?>