<?php
if (isset($_POST['query'])) {
    include "../classes/Database.php";

    $inpText = $_POST['query'];
    $db = new Database();
    $result = $db->recipesAutocomplete($inpText);
    if ($result) {
        foreach ($result as $row) {
            echo '<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3 recipeCardTemplate" data-recipe="' . $row["recipeID"] . '">
                    <div class="h-100 recipeCard">
                    <!-- Content -->
                    <div><img src="' . $row["img"] . '" alt="recepat" class="recipeImg"></div>
                    <div class="w-100 p-3 pt-2 d-flex flex-column">
                    <p class="m-0">' . $row["mealName"] . '</p>
                    <h3 class="text-center my-3">' . $row["recipeTitle"] . '</h3>
                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;' . $row["estTime"] . ' min</p>
                    </div>
                    </div></div>';
        }
    } else {
        echo "<div class='text-center w-100'><p class='h1 text-center text-danger'>No results</p></div>";
    }
}
