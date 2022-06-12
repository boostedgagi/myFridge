<?php
if (isset($_POST['categoryID'])) {
    include "../classes/Database.php";
    $categoryID = $_POST['categoryID'];
    $db = new Database();
    $result = $db->GetCategoryById($categoryID);
    foreach ($result as $row) {
        echo $row["categoryName"];
    }
}
