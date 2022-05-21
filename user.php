<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
include "classes/Database.php";

?>
    <div class="d-flex align-items-center flex-column my-3">
        <h3>Hi <?php echo $_SESSION["userFirstName"].", this is your info."; ?></h3>
            <?php
            $userData = new Database();
            foreach ($userData->getUserData() as $dataRow){
                echo "<li style='list-style: none'>".$dataRow["firstName"]." ".$dataRow["lastName"]."</li>";
                echo "<li style='list-style: none'>".$dataRow["email"]."</li>";
                echo "<li style='list-style: none'>".$dataRow["phoneNumber"]."</li>";
                echo "<li style='list-style: none'><img src=".$dataRow["pppath"]." height='50px' width='50px'></li>";
            }
            ?>
    </div>
    <div class="col-md-5 text-center text-md-start">
    <button class="btn bg-orange btn-lg text-cream">Edit data</button>
    </div>


<?php
include "includes/footer.php";
?>