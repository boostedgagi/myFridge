<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-8 text-center my-5">
        <h1>Recipe input</h1>
        </div>
        
    </div>
    <form action="" method="POST">
    <div class="row justify-content-center mb-2">
        <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
            <label for="text" class="m-0 h6">Title</label>
        </div>
        <div class="col-10 col-md-6 col-lg-4">
        <input type="text" name="text" id="text" class="form-control" placeholder="Example Title">
        </div> 
    </div>
    <div class="row justify-content-center mb-2">
    <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
            <label for="category" class="m-0 h6">Category</label>
        </div>
        <div class="col-10 col-md-6 col-lg-4">
        <select class="form-select" name="category" id="category">
            <option selected>Select category</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        </div>
    </div>

    <div class="row justify-content-center mb-2">
    <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
            <label for="meal" class="m-0 h6">Meal</label>
        </div>
        <div class="col-10 col-md-6 col-lg-4">
        <select class="form-select" name="meal" id="meal">
            <option selected>Select Meal</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        </div>
    </div>

    <div class="row justify-content-center mb-2">
    <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
            <label for="time" class="m-0 h6">Est. Time</label>
        </div>
        <div class="col-10 col-md-6 col-lg-4">
        <input type="text" name="time" id="time" class="form-control" placeholder="ecd. 10min">
        </div>
    </div>


    <div class="row justify-content-center mb-2">
    <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
    <label for="formFile" class="form-label h6">Image</label>
        </div>
        <div class="col-10 col-md-6 col-lg-4">
        <input class="form-control" type="file" id="formFile">
        </div>
    </div>

    <div class="row justify-content-center mb-2">
        <div class="col-10 col-md-8 col-lg-5 text-end">
        <input type="submit" class="btn bg-orange">
        </div>
    </div>
    </form>
</div>

<?php
include 'includes/footer.php';
?>