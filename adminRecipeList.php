<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";
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

        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", "button.allow", function() {
            window.location.href = "./actions/allowUserAction.php?userID=" + $(this).attr("dataId");
            return false;
        });

    });
</script>

<?php
include "includes/adminFooter.php";
?>