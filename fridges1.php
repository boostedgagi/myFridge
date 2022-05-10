<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

<section id="fridges">
<div class="container-lg">
    <div class="row fridges">
        <ul class="fridge-list">
            <li class="fridge-item text-center">Fridge1</li>
            <li class="fridge-item text-center">Fridge2</li>
            <li class="fridge-item text-center">Fridge3</li>
            <li class="fridge-item text-center">Fridge4</li>
            <li class="add-fridge text-center">Add new fridge</li>
        </ul>
    </div>
    <div class="row groceries">
        <div class="menu">
        <ul>
            <li id="add">Add new grocerie</li>
            <li id="show">Show recipes</li>
        </ul>
        </div>
        <div class="items">
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>


            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
            <div class="item">
                <img src="" alt>
                <h3>Title</h3>
                <p>In stock: </p>
            </div>
        </div>
    </div>
</div>

</section>

<?php
include "includes/footer.php";
?>