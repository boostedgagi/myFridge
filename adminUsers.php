<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";
include "includes/adminAddGrocerieModal.php";

if (isset($_SESSION["accountType"]) and $_SESSION["accountType"] === "admin") {

?>

    <div class="container-lg">
        <table id="grid-basic" class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric">ID</th>
                    <th data-column-id="sender">First Name</th>
                    <th data-column-id="sender">Last Name</th>
                    <th data-column-id="sender">Phone number</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="received" data-order="desc">Is allowed</th>
                    <th data-column-id="received" data-order="desc">Allow/Deny</th>
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
                                <td><button class="btn btn-success">Allow</button> <button class="btn btn-danger">Deny</button></td>
                            </tr>';
                } else {
                    echo '<tr>
                                <td>' . $row["userID"] . '</td>
                                <td>' . $row["firstName"] . '</td>
                                <td>' . $row["lastName"] . '</td>
                                <td>' . $row["phoneNumber"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td>' . "No" . '</td>
                                <td><button class="btn btn-success">Allow</button> <button class="btn btn-danger">Deny</button></td>
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
        $("#grid-basic").bootgrid();
    </script>


    <?php
    include "includes/adminFooter.php";
    ?>