<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";
include "includes/adminAddGrocerieModal.php";

?>
<div class="d-flex align-items-center flex-column my-3">
    <button class="btn bg-orange" data-bs-toggle="modal" data-bs-target="#adminAddGrocerie">Add new Grocerie
    </button>
    <br>
    <h2>Current Groceries:</h2>
</div>


<div class="container-lg">
    <table id="grid-basic" class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th data-column-id="id" data-type="numeric">ID</th>
                <th data-column-id="sender">Grocerie name</th>
                <th data-column-id="received" data-order="desc">Grocerie picture</th>
                <th data-column-id="received" data-order="desc">Delete</th>
                <th data-column-id="received" data-order="desc">Edit</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $groceries = new Database();
            foreach ($groceries->getGroceries() as $grocery) {
                echo "<tr>
            <td>" . $grocery["sGrID"] . "</td>
            <td>" . $grocery["sGrName"] . "</td>
            <td><img src='" . $grocery["sGrPicPath"] . "' height='50px' width='50px'></td>
            <td><button onclick=\"location.href='./actions/deleteGrocerieAction.php?grocerieID=" . $grocery['sGrID'] . "'\" class='btn btn-danger'>delete</button></td>
            <td><button class='btn btn-warning'>edit</button></td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include "includes/adminFooter.php";
?>