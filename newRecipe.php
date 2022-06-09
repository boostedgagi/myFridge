<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
include "classes/Database.php";

?>

<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-8 text-center my-5">
            <h1>Recipe input</h1>
        </div>

    </div>
    <form action="./actions/newRecipeAction.php" method="POST" id="add-ingredients">
        <div id="form-items">
            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="text" class="m-0 h6">Title</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <input type="text" name="recipeTitle" id="text" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="category" class="m-0 h6">Category</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <select class="form-select" name="recipeCategory" id="category">
                        <?php
                        $categories = new Database();
                        echo "<option selected value='any'>Select category</option>";
                        foreach ($categories->getCategories() as $category) {
                            echo "<option value=" . $category["categoryID"] . ">" . $category["categoryName"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="meal" class="m-0 h6">Meal</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <select class="form-select" name="recipeMeal" id="meal">
                        <?php
                        $meals = new Database();
                        echo "<option selected value='any'>Select meal</option>";
                        foreach ($meals->getMeals() as $meal) {
                            echo "<option value=" . $meal["mealID"] . ">" . $meal["mealName"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="time" class="m-0 h6">Est. Time</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <input type="text" name="recipeTime" id="time" class="form-control" placeholder="ecd. 10min">
                </div>
            </div>

            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="recipeImg" class="form-label h6">Image</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <input class="form-control" name="recipePicture" type="file" id="recipeImg">
                </div>
            </div>

            <div class="row justify-content-center mb-2">
                <div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label">
                    <label for="text" class="m-0 h6">Ingredient</label>
                </div>
                <div class="col-10 col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ingredient name" aria-label="Ingredient name example" aria-describedby="add">
                        <button class="btn bg-orange" type="button" id="add">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-10 col-md-8 col-lg-5 text-end">
                <input type="submit" name="ingredients[]" class="btn bg-orange" id="submit" name="submit">
            </div>
        </div>
    </form>
</div>
<?php

include 'includes/footer.php';
?>


<script>
    'use strict';
    $(document).ready(function() {
        let i = 1;
        $("#add").click(function() {
            i++;
            $("#form-items").append('<div class="row justify-content-center mb-2" id="row' + i + '"><div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label"><label for="text" class="m-0 h6">Ingredient</label></div><div class="col-10 col-md-6 col-lg-4"><div class="input-group"><input type="text" class="form-control" placeholder="Ingredient name example" aria-label="Ingredient name example" aria-describedby="add"><button class="btn btn-danger btn-remove" type="button" id="' + i + '">X</button></div></div>');

        });
        $(document).on('click', '.btn-remove', function() {
            const buttonId = $(this).attr('id');
            $('#row' + buttonId + '').remove();
            $(this).remove();
        });
        $('submit').click(function() {
            $.ajax({
                url: "../actions/newRecipeAction.php",
                method: "POST",
                data: $("add-ingredients"),
                success: function(data) {
                    alert(data);
                    $('#add-ingredients')[0].reset();
                }
            });
        });
    });
</script>