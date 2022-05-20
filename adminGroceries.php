<?php
session_start();
include "includes/adminHeader.php";
include "includes/adminNav.php";
include "includes/adminAddGrocerieModal.php";
?>
<div class="d-flex align-items-center flex-column my-3">
<button class="btn bg-orange" data-bs-toggle="modal" data-bs-target="#adminAddGrocerie">Add new Grocerie</button><br>   
<h2>Current Groceries:</h2>
</div>


<div class="container-lg">
<table id="grid-basic" class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th data-column-id="id" data-type="numeric">ID</th>
            <th data-column-id="sender">Sender</th>
            <th data-column-id="received" data-order="desc">Received</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>10238</td>
            <td>eduardo@pingpong.com</td>
            <td>14.10.2013</td>
        </tr>
        <tr>
            <td>10238</td>
            <td>eduardo@pingpong.com</td>
            <td>14.10.2013</td>
        </tr><tr>
            <td>10238</td>
            <td>eduardo@pingpong.com</td>
            <td>14.10.2013</td>
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