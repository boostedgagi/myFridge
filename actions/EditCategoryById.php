<?php
if (isset($_POST['editCategory'])) {
    include "../classes/Database.php";
    $categoryID = $_POST['categoryID'];
    $categoryName = $_POST['category'];
    $db = new Database();
    $db->EditCategoryById($categoryName, $categoryID);
}
