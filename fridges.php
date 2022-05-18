<?php
//session_start();

include "includes/addNewFridgeModal.php";
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "includes/login.php";
include "includes/register.php";

include "classes/Database.php";
$listOfAllFridges = new Database();

//if ($listOfAllFridges->rowCountOfFridges() > 0) {
//    foreach ($listOfAllFridges->getAllFridgesForCurrentUser() as $fridge){
//        var_dump($fridge);
//        echo "<br>";
//    }
//}
?>
    <section id="fridges">
        <div class="container-lg">
            <div class="row fridges">
                <ul class="fridge-list">
<!--                <li class="fridge-item text-center">Fridge1</li>-->
                    <?php
                    if ($listOfAllFridges->rowCountOfFridges() > 0) {
                        foreach ($listOfAllFridges->getAllFridgesForCurrentUser() as $oneFridge) {
                            echo "<li class='fridge-item text-center'>". $oneFridge["fridgeName"] ."</li>";
                        }
                    }
                    ?>
                    <li class="fridge-item text-center">
                        <a
                                href="#"
                                style="color: #4f4a4a; text-decoration: none"
                                data-bs-toggle="modal"
                                data-bs-target="#addNewFridgeModal">Add new fridge
                        </a>
                    </li>
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