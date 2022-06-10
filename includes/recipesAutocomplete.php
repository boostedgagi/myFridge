<?php

include_once "Database.php";


if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $db = new Database();
    $result = $db->recipesAutocomplete($inpText);
    if ($result) {
        foreach ($result as $row) {
            echo '<div class="h-100 recipeCard">
                    <!-- Content -->
                    <div><img src="/' . $row["recipeImagePath"] . '" alt="recepat" class="recipeImg"></div>
                    <div class="w-100 p-3 pt-2 d-flex flex-column">
                    <p class="m-0">' . $row["meal_id"] . '</p>
                    <h3 class="text-center my-3">' . $row["recipeTitle"] . '</h3>
                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;' . $row["estTimeInMinutes"] . ' min</p>
                    </div>
                    </div>';
        }
    } else {
        echo "<p class='text-danger'>No results</p>";
    }
}
