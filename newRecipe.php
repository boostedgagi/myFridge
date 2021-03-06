<?php
include "classes/Database.php";
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
    <form id="add-ingredients" action="./actions/newRecipeAction.php" enctype="multipart/form-data" name="add-ingredients" method="POST">
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
                        <input type="text" class="form-control autocomplete" id="ingredient_1" name="name[]" placeholder="Ingredient name">
                        <button class="btn bg-orange" type="button" id="add">Add</button>
                    </div>
                    <div class="d-flex align-items-center flex-column" id="ingredientsList_1">

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-10 col-md-8 col-lg-5 text-end">
                <input type="submit" class="btn bg-orange" id="submit" name="submit">
            </div>
        </div>
    </form>
</div>
<script>
    'use strict';
    $(document).ready(function() {
        let i = 1;
        $("#add").click(function() {
            i++;
            $("#form-items").append('<div class="row justify-content-center mb-2" id="row' + i + '"><div class="text-end align-self-center col-2 col-md-2 col-lg-1 col-form-label"><label for="text" class="m-0 h6">Ingredient</label></div><div class="col-10 col-md-6 col-lg-4"><div class="input-group"><input type="text" id="ingredient_' + i + '" name="name[]" class="form-control autocomplete" placeholder="Ingredient name example"><button class="btn btn-danger btn-remove" type="button" id="' + i + '">X</button></div><div class="d-flex align-items-center flex-column" id="ingredientsList_' + i + '"></div></div>');

        });
        $(document).on('click', '.btn-remove', function() {
            const buttonId = $(this).attr('id');
            $('#row' + buttonId + '').remove();
            $(this).remove();
        });
        $('#submit').click(function() {
            $.ajax({
                url: "./actions/newRecipeAction.php",
                method: "POST",
                data: $("#add-ingredients").serialize(),
                success: function(data) {
                    //alert(data);
                    $('#add-ingredients')[0].reset();
                }
            });
        });
        //autocomplete

        $(document).on('focus', '.autocomplete', autocomplete);


        function autocomplete() {
            let selected = $(this);
            let selectedId = selected.attr("id");
            let selectedIdNumber = selectedId.trim("_");
            let number = selectedIdNumber[selectedIdNumber.length - 1];
            $("#" + selectedId).keyup(function() {
                let searchText = $(this).val();
                if (searchText != "") {
                    $.ajax({
                        url: "classes/GrocerieAutocomplete.php",
                        method: "post",
                        data: {
                            query: searchText,
                        },
                        success: function(response) {
                            $("#ingredientsList_" + number).html(response);
                        },
                    });
                } else {
                    $("#ingredientsList_" + number).html("");
                }
            });
            //Klik na jednu od ponudjenih namirnica popunjava input polje i prazni listu
            $(document).on("click", "div#ingredientsList_" + number + " > p", function() {
                $("#ingredient_" + number).val($(this).text());
                $("#ingredientsList_" + number).html("");
            });
        }
    });
</script>
<?php

include 'includes/footer.php';
?>