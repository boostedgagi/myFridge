<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/userPageAuthentication.php";
?>

<div style="width: 450px; padding:50px; align-self: center">
    <form method="post" action="actions/addNewFridgeAction.php">
        <label>Insert name of the new fridge,up to 30 characters</label>
        <input type="text" class="form-control" name="fridgeName">
        <button type="submit" name="newFridgeSubmit">Insert new fridge</button>
    </form>
</div>
<?php
include "includes/footer.php";
?>
