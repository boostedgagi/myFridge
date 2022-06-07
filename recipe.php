<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<div class="container-lg mt-3">
    <div class="row justify-content-center p-3">
        <div class="col-12 col-md-8 col-lg-6">
        <h1 class="mt-3 mb-5 p-3 border-bottom border-warning">Recipe Title</h1>
        </div></div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 p-3">
            <div class="d-flex justify-content-center align-items-center rounded-3" style="height:400px;background-color:#666">
            <h1>Image</h1>
            </div>
            </div>
        </div>
<div class="row justify-content-center mt-5 p-3">
    <div class="col-12 col-md-8 col-lg-6">
<h3 class="m-0">Recipe information</h3>
<p class="p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, impedit eveniet modi tenetur nihil quidem repellat ad eaque fuga nesciunt sint fugit dolor natus officia ipsam adipisci eum perferendis facilis.</p>
</div>
</div>

<div class="row justify-content-center p-3">
    <div class="col-12 col-md-8 col-lg-6 bg-yellow rounded-3 p-5">
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

<div class="comments row justify-content-center mt-5 p-3 ">
    <div class="col-12 col-md-8 col-lg-6">
    <p class="p-3 border-bottom mb-1">0 Comments</p>
    </div></div>
    <div class="comments row justify-content-center p-3">
    <div class="col-10 col-md-8 col-lg-4">
    <p class="p-3 pb-0 m-0">New Comment</p>
    </div>
    <div class="col-2 col-md-2 col-lg-2 align-self-end">
    <button class="btn bg-orange">Submit</button>
    </div></div>
    
    <div class="row justify-content-center p-3 mb-5">
        <div class="col-4 col-md-2 col-lg-2 col-xxl-1 col-xs-4">
        <div class="bg-orange w-100" style="height: 100px;">Profile image</div>
        </div>
        <div class="col-8 col-md-6 col-lg-4 col-xxl-5 col-xs-8">
        <textarea class="w-100" name="comment" id="comment" cols="10" rows="5" placeholder="Your comment..." style="height: 100px;"></textarea>
        </div>
    </div>


</div>

<?php
include 'includes/footer.php';
?>