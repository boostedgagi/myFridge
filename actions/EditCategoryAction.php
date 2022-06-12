<?php
if (isset($_POST['editCategory'])) {

    $categoryID = $_GET['categoryID'];
    $categoryName = $_POST['categoryName'];

    include "../classes/Database.php";
    include "../classes/EditCategory.php";
    include "../classes/EditCategoryControl.php";
echo $categoryID;
echo $categoryName;

}
