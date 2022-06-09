<!-- Add New Fridge -->
<div class="modal fade" id="addNewFridgeModal" tabindex="-1" aria-labelledby="addNewFridgeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- FRIDGE INSERT FORM -->
                <form action="actions/addNewFridgeAction.php" method="post">
                    <h1 class="text-center mb-5">Add new fridge</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingFridge" name="fridgeName" placeholder="new fridge name">
                        <label for="floatingFridge">Insert name</label>
                    </div>
                    <button type="submit" name="newFridgeSubmit" class="btn-lg btn-primary my-3 rounded-pill">
                        Add new fridge
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>