<!-- ADD CATEGORY -->
<div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="editCatModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- CATEGORY INSERT FORM -->
                <form action="actions/EditCategoryById.php" method="post">
                    <h1 class="text-center mb-5">Add category</h1>
                    <label for="editCatModal">Insert title</label>
                    <input type="text" class="form-control" id="editCatModal" name="category" placeholder="" value="">
                    <button type="submit" name="editCategory" value="editCategory" class="btn-lg btn-primary my-3 rounded-pill">
                        Change category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>