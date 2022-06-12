<!-- ADD CATEGORY -->
<div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="addCatModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- CATEGORY INSERT FORM -->
                <form action="actions/addCatModalAction.php" method="post">
                    <h1 class="text-center mb-5">Add category</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="addCatModal" name="category" placeholder="addCatModal">
                        <label for="addCatModal">Insert title</label>
                    </div>
                    <button type="submit" name="newCategory" value="newCategory" class="btn-lg btn-primary my-3 rounded-pill">
                        Add category
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>