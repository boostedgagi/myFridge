<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "includes/editUserDataModal.php";
include "classes/Database.php";

?>
    <h3 class="text-center">Hi <?php echo $_SESSION["userFirstName"] . ", this is your info."; ?></h3>
    <div class="userInfoContainer d-flex align-items-center flex-column my-3">
        <div class="p-3 bg-white rounded-2" id="userInfo">
            <?php
            $userData = new Database();
            foreach ($userData->getUserData() as $dataRow) {
                echo "<div class='d-flex align-items-center flex-column p-0'><div class='mb-1'><img src=" . $dataRow["pppath"] . " class='rounded-circle border-3 border-orange' height='80px' width='80px'></div>";
                echo "<div class='mb-2'><h3>" . $dataRow["firstName"] . " " . $dataRow["lastName"] . "</h3></div>";
                echo "<div class='mb-2'><p class='m-1'>" . $dataRow["email"] . "</p></div>";
                echo "<div class='mb-2'><p class='m-1'>" . $dataRow["phoneNumber"] . "</p></div></div>";
            }
            ?>
            <div class="d-flex justify-content-center">
                <button 
                class="btn bg-orange text-cream" 
                data-bs-toggle="modal"
                data-bs-target="#editUser"
                >Edit data</button>
            </div>
        </div>
    </div>


<?php
include "includes/footer.php";
?>