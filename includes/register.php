<!-- REGISTER MODAL -->
<div
    class="modal fade"
    id="registermodal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
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
                <!-- REGISTER FORM -->
                <form>
                    <h1 class="text-center mb-5">Register</h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        placeholder="name"
                                    />
                                    <label for="name">First Name</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="lastname"
                                        placeholder="lastname"
                                    />
                                    <label for="lastname">Last name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="register-email"
                                        placeholder="email"
                                    />
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="register-password"
                                        placeholder="password"
                                    />
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="confirmpassword"
                                        placeholder="confirmpassword"
                                    />
                                    <label for="confirmpassword">Confirm password</label>
                                </div>
                            </div>
                            <!-- Countries and cities
                               <div class="col-6">
                            <select class="form-select" aria-label="country" name="countries" id="countries">
                            </select>
                          </div>
                          <div class="col-6">
                            <select class="form-select" aria-label="city" name="city">
                              <option selected>City</option>
                              <option value="1">Subotica</option>
                              <option value="2">Nis</option>
                              <option value="3">Beograd</option>
                            </select>
                          </div> -->
                            <!-- class mt-3 -->
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="phone"
                                        placeholder="phone"
                                    />
                                    <label for="phone">Phone number</label>
                                </div>
                            </div>
                            <div class="col-10">
                                <label for="formFile" class="form-label">Choose profile picture (Up to 5MB)</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    class="btn-lg btn-primary my-3 rounded-pill"
                                >
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <p class="">
                            Already have an account?<a href="#" class="link-primary" data-bs-toggle="modal"
                                                       data-bs-target="#loginmodal">
                                Log In</a
                            >
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>