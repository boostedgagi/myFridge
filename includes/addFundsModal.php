<!-- Add FUNDS -->
<div class="modal fade" id="addFundsModal" tabindex="-1" aria-labelledby="addFundsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- FUND INSERT FORM -->
                <form action="actions/addFundsAction.php" method="post">
                    <h1 class="text-center mb-5">Add funds</h1>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingFund" name="funds" placeholder="new funds value">
                        <label for="floatingFund">Insert funds</label>
                    </div>
                    <button type="submit" name="newFundSubmit" value="newFundSubmit" class="btn-lg btn-primary my-3 rounded-pill">
                        Add funds
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>