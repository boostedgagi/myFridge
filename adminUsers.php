<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";

if (isset($_SESSION["accountType"]) and $_SESSION["accountType"] === "admin") {

?>

    <div class="container-lg">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric">ID</th>
                    <th data-column-id="fistName">First Name</th>
                    <th data-column-id="lastName">Last Name</th>
                    <th data-column-id="phoneNumber">Phone number</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="allowed" data-order="desc">Is allowed</th>
                    <th data-column-id="allowDeny" data-order="desc">Allow/Deny</th>
                </tr>
            </thead>
        <?php
        $db = new Database();
        $db1 = new Database();

        $result = $db->ListUsers();
        if ($result) {
            foreach ($result as $row) {
                echo "<tbody>";
                $isAllowed = $db1->IsAllowed($row["userID"]);
                if ($isAllowed === TRUE) {
                    echo '<tr>
                                <td>' . $row["userID"] . '</td>
                                <td>' . $row["firstName"] . '</td>
                                <td>' . $row["lastName"] . '</td>
                                <td>' . $row["phoneNumber"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td>' . "Yes" . '</td>
                                <td><button class="btn btn-success">Allow</button> <button class="btn btn-danger deny" dataId = ' . $row["userID"] . '>Deny</button></td>
                            </tr>';
                } else {
                    echo '<tr>
                                <td>' . $row["userID"] . '</td>
                                <td>' . $row["firstName"] . '</td>
                                <td>' . $row["lastName"] . '</td>
                                <td>' . $row["phoneNumber"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td>' . "No" . '</td>
                                <td><button class="btn btn-success allow" dataId = ' . $row["userID"] . '>Allow</button> <button class="btn btn-danger">Deny</button></td>
                            </tr>';
                }
            }
        }
    }
        ?>
        </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on("click", "button.allow", function() {
                window.location.href = "./actions/allowUserAction.php?userID=" + $(this).attr("dataId");
                return false;
            });
            $(document).on("click", "button.deny", function() {
                window.location.href = "./actions/denyUserAction.php?userID=" + $(this).attr("dataId");
                return false;
            });
        });
    </script>
    <?php
    include "includes/adminFooter.php";
    ?>