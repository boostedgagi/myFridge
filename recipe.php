<?php
include "classes/Database.php";
include "includes/header.php";
include "includes/nav.php";
//include "includes/userPageAuthentication.php";

include "includes/login.php";
include "includes/register.php";
include "includes/recipesAutocomplete.php";

if (isset($_GET["recipeID"])) {
    $recipeID = $_GET["recipeID"];
    $db = new Database();
    $rows = $db->recipeFiller($recipeID);
    foreach ($rows as $row) {
?>

        <div class="container-lg mt-3">
            <div class="row justify-content-center p-3">
                <div class="col-12 col-md-8 col-lg-6">
                    <h1 class="mt-3 mb-5 p-3 border-bottom border-warning"><?php echo $row["recipeTitle"] ?></h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 p-3">
                    <div class="d-flex justify-content-center align-items-center rounded-3" style="height:400px;">
                        <img src="<?php echo $row["img"] ?>" class="img-fluid rounded-e" alt="" width="100%" height="400">
                    </div>
                </div>
            </div>
            <!-- <div class="row justify-content-center mt-5 p-3">
            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="m-0">Recipe information</h3>
                <p class="p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, impedit eveniet modi tenetur nihil quidem repellat ad eaque fuga nesciunt sint fugit dolor natus officia ipsam adipisci eum perferendis facilis.</p>
            </div>
        </div> -->

            <div class="row justify-content-center p-3">
                <div class="col-12 col-md-8 col-lg-6 bg-yellow rounded-3 p-5">
                    <div class="d-flex flex-column border-bottom">
                        <h4 class="">Time to prepare</h4>
                        <p><?php echo $row["estTime"] ?> min</p>
                    </div>
                    <div class="my-3 d-flex flex-column border-bottom">
                        <h4 class="">Category</h4>
                        <p><?php echo $row["categoryName"] ?></p>
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
                    <!-- <button class="btn bg-orange my-2">Make recepie</button> -->
                </div>
            </div>

            <?php if(isset($_SESSION["userEmail"])){ ?>
            <div class="comments row justify-content-center mt-5 p-3 ">
                <div class="col-12 col-md-8 col-lg-6">
                    <p class="p-3 border-bottom mb-1">0 Comments</p>
                </div>
            </div>

            <div class="comments row justify-content-center p-3">
                <div class="col-10 col-md-8 col-lg-4">
                    <p class="p-3 pb-0 m-0">New Comment</p>
                </div>
                <div class="col-2 col-md-2 col-lg-2 align-self-end">
                    <button form="commentForm" name="newCommentSubmit" type="submit" class="btn bg-orange">Submit</button>
                </div>
            </div>
            <form method="post" id="commentForm" action="actions/commentAction.php">

            <div class="row justify-content-center p-3 mb-5">
                <div class="col-4 col-md-2 col-lg-2 col-xxl-1 col-xs-4">
                    <div class="bg-orange w-100" style="height: 100px;"><img src="<?php echo $_SESSION["userProfilePicture"]; ?>" height="100px"></div>
                </div>
                <div class="col-8 col-md-6 col-lg-4 col-xxl-5 col-xs-8">
                    <textarea class="w-100" name="comment" id="comment" cols="10" rows="5" placeholder="Your comment..." style="height: 100px;"></textarea>
                    <input type="hidden" name="recipeID" value="<?php echo $_GET["recipeID"]; ?>">
                </div>
            </div>
            </form>

            <?php } else {
                echo "<h3>Please log in for more content.</h3>";

            }?>
        </div>
<?php
    }
}

include 'includes/footer.php';
?>