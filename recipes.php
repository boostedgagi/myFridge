<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<div class="container-lg my-5">

<div class="row justify-content-center my-4">
    <div class="col-9">
        <input type="text" name="recipeName" id="recipeName" class="form-control recipeSearch" placeholder="Start typing...">
    </div>
</div>
<div class="row g-3 justify-content-center">
    <div class="col-9">
    <div class="bg-white recipe-list p-3">
        <h1 class="text-center">Recipes</h1>
    </div>
    </div>
</div>
</div>

<?php
include 'includes/footer.php';
?>