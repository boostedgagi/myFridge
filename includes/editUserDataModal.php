<!-- Edit Data User MODAL -->
<div
    class="modal fade"
    id="editUser"
    tabindex="-1"
    aria-labelledby="editUser"
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
                <!-- editUser FORM -->
                <form onsubmit="return validation()" action="" enctype="multipart/form-data" method="post" >
                    <h1 class="text-center mb-5">Change</h1>
                    
                    <label for="firstName" class="form-label">First name:</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Change your first name">

                    <label for="lastName" class="form-label mt-3">Last name:</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Change your last name">

                    <label for="phoneNumber" class="form-label mt-3">Phone number:</label>
                    <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Change your phone number">
                    
                    <label for="formFile" class="form-label mt-3">Choose profile picture (Up to 5MB)</label>
                    <input class="form-control mb-3" type="file" name="reg-prof-img-path" id="formFile">
                    
                    <button
                        type="submit"
                        name="editUser-submit"
                        class="btn-lg btn-primary my-3 rounded-pill"
                    >
                        Change
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>