<!-- Add New Grocerie ADMIN-->
<div
        class="modal fade"
        id="adminAddGrocerie"
        tabindex="-1"
        aria-labelledby="adminAddGrocerie"
        aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                ></button>
                <!-- GROCERIE INSERT FORM -->
                <!-- Treba dodati action -->
                <form method="post" action="../actions/addNewGrocerieAdminAction.php">
                    <h1 class="text-center mb-5">Add new Grocerie</h1>
                    <div class="mb-3">
                        <label for="grocerieName" class="form-label">Grocerie Name:</label>
                        <input type="text" class="form-control" id="grocerieName" placeholder="Apple,Banana...">
                    </div>
                    <select class="form-select my-3" aria-label="selectUnit">
                        <option selected>Select Unit</option>
                        <?php

                        $units = new Database();
                        foreach ($units->getGrocerieUnits() as $unit) {
                            echo "<option value='".$unit."'>'".$unit."'</option>";
                        }
                        ?>
                    </select>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Select image:</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <button
                            type="submit"
                            name="adminGrocerieSubmit"
                            class="btn-lg btn-primary my-3 rounded-pill"
                    >
                        Add new Grocerie
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
