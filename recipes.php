<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<div class="container-lg my-5">

    <div class="row justify-content-center my-2 mt-4">
        <div class="col-12 col-sm-10 col-lg-9">
            <input type="text" name="recipeName" id="recipeName" class="form-control recipeSearch" placeholder="Start typing...">
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-12 col-sm-10 col-lg-9 accordion">
            <div class="accordion-item accordion-button bg-white text-center filters btn w-100 collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h4>Filters</h4>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse container-fluid p-0" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body bg-white filters">
                    <div class="row row-cols-3">
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Price limit" min="0">
                                <label class="input-group-text">$</label>
                                <?php
                                if (isset($_SESSION["userEmail"])) {
                                    echo '<div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox" value="" id="budget" aria-label="Checkbox for following text input">
                                    <label for="budget"> &nbsp Budget</label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <select class="form-select" name="category" id="category">
                                <option selected>Select category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <select class="form-select" name="meal" id="meal">
                                <option selected>Select Meal</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Est. Time" min="0">
                                <label class="input-group-text">min</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 justify-content-center">
        <div class="col-12 col-sm-10 col-lg-9">
            <div class="bg-white recipe-list p-3">
                <h1 class="text-center">Recipes</h1>
                <div class="container-fluid">
                    <div class="row row-cols-4">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3 recipeCardTemplate">
                            <div class="h-100 recipeCard">
                                <!-- Content -->
                                <div><img src="./images/recept2.jpg" alt="recepat" class="recipeImg"></div>
                                <div class="w-100 p-3 pt-2 d-flex flex-column">
                                    <p class="m-0">Breakfast</p>
                                    <h3 class="text-center my-3">Title</h3>
                                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;20 min</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3  p-3 recipeCardTemplate">
                            <div class="h-100 recipeCard">
                                <!-- Content -->
                                <div><img src="./images/recept2.jpg" alt="recepat" class="recipeImg"></div>
                                <div class="w-100 p-3 pt-2 d-flex flex-column">
                                    <p class="m-0">Breakfast</p>
                                    <h3 class="text-center my-3">Title</h3>
                                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;20 min</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3 recipeCardTemplate">
                            <div class="h-100 recipeCard">
                                <!-- Content -->
                                <div><img src="./images/recept2.jpg" alt="recepat" class="recipeImg"></div>
                                <div class="w-100 p-3 pt-2 d-flex flex-column">
                                    <p class="m-0">Breakfast</p>
                                    <h3 class="text-center my-3">Title</h3>
                                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;20 min</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3 recipeCardTemplate">
                            <div class="h-100 recipeCard">
                                <!-- Content -->
                                <div><img src="./images/recept2.jpg" alt="recepat" class="recipeImg"></div>
                                <div class="w-100 p-3 pt-2 d-flex flex-column">
                                    <p class="m-0">Breakfast</p>
                                    <h3 class="text-center my-3">Title</h3>
                                    <p class="h5"><i class="bi bi-clock-history"></i>&nbsp;20 min</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>