<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";

include "classes/Database.php";
$dbObj1 = new Database();
$usernamesListForAutocomplete = array();
$usernamesListForAutocomplete = $dbObj1->getAllUsernames();

$dbObj2 = new Database();
$newRoommateRequests = array();
$newRoommateRequests =$dbObj2->checkForNewRoommateRequests();

echo $newRoommateRequests["senderID"];
?>
    <p>Add your roommate, and cook together with him!</p>
    <!--riki ovo ces
    ovde ti da menjas i da trpas sve na sredinu, ja sam stavio minimalmo stvari koje su mi potrebne za izradu funkcionalnosti-->

    <div id="roommateSearch" style="display: flex; justify-content: center">
        <input type="email" id="roommateEmailIInput" onkeyup="showResults(this.value)">
        <button type="submit">
            <img src="images/roommateSearchIcon.png" height="32" width="32" border="0px">
        </button>
    </div>
    <div id="resultDiv">

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
                list += '<tr><td>Add your roommate here: <a href="actions/addnewroommateaction.php?receiverEmail='+terms[i]+'">' + terms[i] + '</a></td></tr>';
            }
            result.innerHTML = '<table>' + list + '</table>';
        }
    </script>
<?php
include "includes/footer.php";
?>