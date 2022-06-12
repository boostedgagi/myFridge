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
                <th data-column-id="categoryName">Name</th>
                <th data-column-id="action">Action</th>
            </tr>
        </thead>
        <?php
        $db = new Database();
        $result = $db->getCategories();
        if ($result) {
            foreach ($result as $row) {
                echo '<tr>
                        <td>' . $row["categoryID"] . '</td>
                        <td>' . $row["categoryName"] . '</td>
                        <td><button class="btn btn-danger delete" dataId = ' . $row["categoryID"] . '>Delete</button> <button class="btn btn-warning" dataId = ' . $row["categoryID"] . '>Edit</button></td>
                      </tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", "button.delete", function() {
            window.location.href = "./actions/allowUserAction.php?userID=" + $(this).attr("dataId");
            return false;
        });

    });
</script>
<?php
include "includes/adminFooter.php";
?>