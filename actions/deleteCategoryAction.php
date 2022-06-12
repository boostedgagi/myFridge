<?php
if (isset($_GET['categoryID'])) {
    include "../classes/Database.php";
    $categoryID = $_GET['categoryID'];
    $db = new Database();
    $result = $db->deleteCategoryAction($categoryID);
    header("Location: ../adminRecipeCategory.php");
}
