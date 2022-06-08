<?php
//session_start();



include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "includes/login.php";
include "includes/register.php";

include "classes/Database.php";

include "includes/addNewFridgeModal.php";
include "includes/addNewGrocerieModal.php";
$listOfAllFridges = new Database();

//if ($listOfAllFridges->rowCountOfFridges() > 0) {
//    foreach ($listOfAllFridges->getAllFridgesForCurrentUser() as $fridge){
//        var_dump($fridge);
//        echo "<br>";
//    }
//}
?>
    <section id="fridges">
        <div class="container-lg d-flex justify-content-center align-items-center flex-column ">
            <div class="row fridges d-none d-lg-inline">
                <ul class="fridge-list">
<!--                <li class="fridge-item text-center">Fridge1</li>-->
                    <?php
                    if ($listOfAllFridges->rowCountOfFridges() > 0) {
                        foreach ($listOfAllFridges->getAllFridgesForCurrentUser() as $oneFridge) {
                            echo "<li class='fridge-item d-flex justify-content-center align-items-center text-center fridge-class fridge-for-js' onclick='changeMyColor()'>". $oneFridge["fridgeName"] ."</li>";
                        }
                    }
                    ?>
                    <li class="text-center add-fridge">
                        <a
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#addNewFridgeModal">Add new fridge
                        </a>
                    </li>
                </ul>
                
            </div>
            <div class="row fridges dropdown d-lg-none d-inline">
                <button class="btn bg-white dropdown-toggle" type="button" id="FridgeList" data-bs-toggle="dropdown" aria-expanded="false">
                 Fride List
                </button>
                <ul class="dropdown-menu" aria-labelledby="FridgeList">
                <?php
                    if ($listOfAllFridges->rowCountOfFridges() > 0) {
                        foreach ($listOfAllFridges->getAllFridgesForCurrentUser() as $oneFridge) {
                            echo "<li class='fridge-item text-center my-2'>". $oneFridge["fridgeName"] ."</li>";
                        }
                    }
                    ?>
                    <li class="fridge-item text-center add-fridge my-2">
                        <a
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#addNewFridgeModal">Add new fridge
                        </a>
                    </li>
                    </ul>
                </div>
            <div class="row groceries justify-content-center">
                <div class="menu">
                    <ul>
                        <li id="add" class="text-center" data-bs-toggle="modal" data-bs-target="#addNewGrocerieModal">Add new grocerie</li>
                        <li id="show" class="text-center">Show recipes</li>
                    </ul>
                </div>
                <div class="items">

                    <?php
                    $groceries = new Database();
                    if(count($groceries->getGrocerieData())===0){
                        echo "<h3>You don't have any groceries..</h3>";
                    }
                    foreach ($groceries->getGrocerieData() as $oneGrocerie) {
                        echo "<div class='item d-flex flex-column align-items-center'>
                        <img class='img-fluid' src='".$oneGrocerie['gpp']."' alt>
                        <h4 class='m-0 my-1'>Title:".$oneGrocerie["grocerieName"]."</h4>
                        <p class='m-0 align-self-start'>Amount: x".$oneGrocerie["grocerieAmount"]."</p>
                        <p class='m-0'>Fridge: ".$oneGrocerie["fridgeName"]."</p>
                    </div>";
                    }
                    ?>

                </div>
            </div>
        </div>

    </section>
<script src="js/amount.js"></script>
<script src="js/fridges.js"></script>
<?php
include "includes/footer.php";
?>