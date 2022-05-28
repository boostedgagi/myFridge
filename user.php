<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "classes/Database.php";

?>
    <h3 class="text-center">Hi <?php echo $_SESSION["userFirstName"] . ", this is your info."; ?></h3>
    <div class="userInfoContainer d-flex align-items-center flex-column my-3">
        <div class="p-3 bg-white rounded-2" id="userInfo">
            <?php
            $userData = new Database();
            foreach ($userData->getUserData() as $dataRow) {
                echo "<ul class='d-flex align-items-center flex-column p-0'><li class='mb-1'><img src=" . $dataRow["pppath"] . " class='rounded-circle border-3 border-orange' height='80px' width='80px'></li>";
                echo "<li class='mb-2'><h3>" . $dataRow["firstName"] . " " . $dataRow["lastName"] . "</h3></li>";
                echo "<li class='mb-2'>" . $dataRow["email"] . "</li>";
                echo "<li class='mb-2'>" . $dataRow["phoneNumber"] . "</li></ul>";
            }
            ?>
            <div class="d-flex justify-content-center">
                <button class="btn bg-orange text-cream">Edit data</button>
            </div>
        </div>
    </div>


<?php
include "includes/footer.php";
?>