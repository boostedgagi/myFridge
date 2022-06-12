<?php
session_start();

include "includes/adminHeader.php";
include "includes/adminNav.php";
include "classes/Database.php";
include "includes/addRecipeCategoryModal.php";
include "includes/editRecipeCategoryModal.php";
?>
<div class="container-lg">
    <a href="#" data-bs-toggle="modal" class="ms-2 btn bg-orange" data-bs-target="#addCatModal">Add Category
    </a>

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
        $deletePath = "";
        if ($result) {
            foreach ($result as $row) {
                $deletePath="actions/deleteCategoryAction.php?categoryID=".$row["categoryID"];
                echo '<tr>
                        <td>' . $row["categoryID"] . '</td>
                        <td>' . $row["categoryName"] . '</td>
                        <td><button class="btn btn-danger delete" dataId = ' . $row["categoryID"] . ' onclick="location.href='."'".$deletePath."'".'">Delete</button> 
                        <button class="btn btn-warning edit" dataId = ' . $row["categoryID"] . ' dataName = ' . $row["categoryName"] . ' data-bs-target="#editCatModal" data-bs-toggle="modal">Edit</button></td>
                      </tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
<script>/*
    $(document).ready(function() {
        $('#editCatModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).attr("dataId");
            $.ajax({
                type: 'post',
                url: '../actions/GetCategoryById.php', //Here you will fetch records 
                data: 'categoryID=' + rowid, //Pass $id
                success: function(data) {
                    alert("hello");
                    $("#editCatModal").show();
                    $('input#editCatModal').val(data); //Show fetched data from database
                }
            });
        });
    });*/
</script>
<?php
include "includes/adminFooter.php";
?>