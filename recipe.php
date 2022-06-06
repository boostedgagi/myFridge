<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<div class="container-lg d-flex flex-column align-items-center mt-3">
    <h1 class="mt-3 mb-5 p-3 border-bottom border-warning w-50">Recipe Title</h1>
<div class="d-flex justify-content-center align-items-center w-50 rounded-3" style="height:400px;background-color:#666">
    <h1>Image</h1>
</div>
<div class="w-50 mt-5">
<h3 class="m-0">Recipe information</h3>
<p class="p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, impedit eveniet modi tenetur nihil quidem repellat ad eaque fuga nesciunt sint fugit dolor natus officia ipsam adipisci eum perferendis facilis.</p>
</div>

<div class="w-50 bg-yellow p-3 rounded-3">
    <div class="d-flex flex-column border-bottom">
        <h4 class="">Time to make</h4>
        <p>40 min</p>
    </div>
    <div class="my-3 d-flex flex-column border-bottom">
        <h4 class="">Category</h4>
        <p>Breakfast</p>
    </div>
    <div class="my-3 d-flex flex-column border-bottom">
        <h4>Ingredients</h4>
        <ul class="ingredients">
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
        </ul>
    </div>
    <button class="btn bg-orange my-2">Make recepie</button>
</div>

</div>

<?php
include 'includes/footer.php';
?>