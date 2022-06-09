<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";
include "includes/adminAddGrocerieModal.php";
?>

<div class="container-lg">
    <table id="grid-basic" class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th data-column-id="id" data-type="numeric">ID</th>
                <th data-column-id="sender">Username</th>
                <th data-column-id="email">Email</th>
                <th data-column-id="received" data-order="desc">Is allowed</th>
                <th data-column-id="received" data-order="desc">Allow/Deny</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>10238</td>
                <td>Marko</td>
                <td>eduardo@pingpong.com</td>
                <td>Allowed</td>
                <td><button class="btn btn-success">Allow</button> <button class="btn btn-danger">Deny</button></td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $("#grid-basic").bootgrid();
</script>


<?php
include "includes/adminFooter.php";
?>