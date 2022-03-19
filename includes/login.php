<!-- LOGIN MODAL -->
<div
    class="modal fade"
    id="loginmodal"
    tabindex="-1"
    aria-labelledby="loginmodal"
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
                <!-- LOGIN FORM -->
                <form action="../actions/loginAction.php" enctype="multipart/form-data" method="post">
                    <h1 class="text-center mb-5">Log In</h1>
                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            class="form-control"
                            id="login-email"
                            name="login-email"
                            placeholder="email"
                        />
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input
                            type="password"
                            class="form-control"
                            id="login-password"
                            name="login-pwd"
                            placeholder="password"
                        />
                        <label for="password">Password</label>
                        <a href="#" class="mt-3">Forgot password?</a>
                    </div>
                    <button
                        type="submit"
                        name="login-submit"
                        class="btn-lg btn-primary my-3 rounded-pill"
                    >
                        Log In
                    </button>

                    <div class="modal-footer justify-content-center">
                        <p class="">
                            Don't have an account?
                            <a
                                href="#"
                                class="link-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#registermodal"
                            >
                                Sign up</a
                            >
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>