<?php
if (isset($_POST['newCategory'])) {
    include "../classes/Database.php";
    $categoryName = $_POST['category'];
    $db = new Database();
    $result = $db->InsertCategory($categoryName);
    header("Location: ../adminRecipeCategory.php");
}
