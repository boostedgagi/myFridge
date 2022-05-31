<!-- Add New Grocerie -->
<div
        class="modal fade"
        id="addNewGrocerieModal"
        tabindex="-1"
        aria-labelledby="addNewGrocerieModal"
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
                <form method="post">
                    <h1 class="text-center mb-5">Add new Grocerie</h1>
                    <div class="form-floating">
                        <input
                                type="text"
                                class="form-control"
                                id="grocerieInput"
                                name="grocerieName"
                                placeholder="new grocerie name"
                        >
                        <label for="grocerieInput">Insert name</label>
                    </div>
                    <div class="list-group d-flex justify-content-center" id="show-list">
                    <script>

$(document).ready(function () {
  $("#grocerieInput").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "classes/GrocerieAutocomplete.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  //Klik na jednu od ponudjenih namirnica popunjava input polje i prazni listu
  $(document).on("click", "p", function () {
        $("#grocerieInput").val($(this).text());
        $("#show-list").html("");
      
    
  });
});
                    </script>
                    </div>
                    <div class="form-floating my-3">
                        <select name="selectedFridge">
                            <option value="any" selected>Choose fridge</option>
                            <?php
                            $fridges = new Database();
                            foreach ($fridges->getAllFridgesForCurrentUser() as $fridge) {
                                echo "<option value='".$fridge["fridgeName"]."'>". $fridge["fridgeName"] ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <div class="btn btn-primary rounded-2" id="minus"> -</div>
                        <input type="text" id="amount" class="rounded-2 text-center" value="1 Amountunit" readonly>
                        <div class="btn btn-primary rounded-2" id="plus"> +</div>
                        <br>
                    </div>
                    <button
                            type="submit"
                            name="newGrocerieSubmit"
                            class="btn-lg btn-primary my-3 rounded-pill"
                    >
                        Add new Grocerie
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
