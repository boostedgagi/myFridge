<?php

include_once "Database.php";


if(isset($_POST['query'])){
    $inpText = $_POST['query'];
    $db = new Database();
    $result = $db->GrocerieAutocomplete($inpText);
    if($result){
        foreach($result as $row) {
            echo "<p class='rounded-1 border-bottom border-1'>". $row['suggGrocName'] ."</p>";
        }
    } else {
    echo "<p class='rounded-1 border-bottom border-1'>No results</p>";
    }
}
