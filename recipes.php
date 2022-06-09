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
            <div class="row">
                <div class="col-4">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Price limit">
                    <label class="input-group-text">$</label>
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
    </div>
    </div>
</div>
</div>

<?php
include 'includes/footer.php';
?>