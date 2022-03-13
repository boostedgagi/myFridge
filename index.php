<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/main.css"/>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />
    <title>Fridge</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-xxl">
        <a href="#top" class="navbar-brand">
            <span class="fw-bold text-black"> MyFridge </span>
        </a>
        <!-- Nav for mobile -->
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#main-nav"
                aria-controls="main-nav"
                aria-expanded="false"
                aria-label="Toggle navigation"
                onclick="rotating()"
        >
            <span class="hamburger"></span>
            <span class="hamburger"></span>
            <span class="hamburger"></span>
        </button>

        <!-- Nav items -->
        <div
                class="collapse navbar-collapse justify-content-end align-center"
                id="main-nav"
        >
            <ul class="navbar-nav text-center">
                <li class="nav-item" >
                    <a href="#" class="nav-link text-black">Home</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="#" class="nav-link text-black">Nesto1</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="#" class="nav-link text-black">Nesto2</a>
                </li>
                <li class="nav-item d-inline d-md-none ms-1">
                    <a
                            href="#"
                            class="nav-link btn text-black"
                            data-bs-toggle="modal"
                            data-bs-target="#loginmodal"
                    >LogIn</a
                    >
                </li>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a
                            href="#"
                            class="nav-link btn bg-orange text-cream"
                            data-bs-toggle="modal"
                            data-bs-target="#loginmodal"
                    >LogIn</a
                    >
                </li>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a
                            href="#"
                            class="nav-link btn bg-orange text-cream"
                            data-bs-toggle="modal"
                            data-bs-target="#registermodal"
                    >Register</a
                    >
                </li>
            </ul>
        </div>
    </div>
</nav>
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
                <form>
                    <h1 class="text-center mb-5">Log In</h1>
                    <div class="form-floating mb-3">
                        <input
                                type="email"
                                class="form-control"
                                id="login-email"
                                placeholder="email"
                        />
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input
                                type="password"
                                class="form-control"
                                id="login-password"
                                placeholder="password"
                        />
                        <label for="password">Password</label>
                        <a href="#" class="mt-3">Forgot password?</a>
                    </div>
                    <button
                            type="submit"
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

<!-- TOP -->
<section id="top">
    <div class="container-lg">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 text-center text-md-start">
                <h1>
                    <div class="display-2 text-black">MyFridge</div>
                    <div class="display-5 text-brown">
                        Lorem ipsum dolor sit amet.
                    </div>
                </h1>
                <p class="lead my-4 text-brown">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                </p>
                <a href="#" class="btn bg-orange btn-lg text-cream">Find recipes</a>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <img src="images/slika1.png" alt="Hamburger" class="img-fluid"/>
            </div>
        </div>
    </div>
</section>

<!-- RECIPES -->
<section id="recipes" class="bg-color">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
                fill="#E7E393"
                fill-opacity="1"
                d="M0,224L60,202.7C120,181,240,139,360,128C480,117,600,139,720,138.7C840,139,960,117,1080,96C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"
        ></path>
    </svg>
    <div class="container-lg">
        <div class="text-center">
            <h2>Popular recipes</h2>
            <p class="lead text-muted">Choose one of our popular recipes</p>
        </div>
        <div class="row my-5 align-items-center justify-content-center g-4">
            <div class="col-8 col-md-7 col-xl-4">
                <div class="card">
                    <img
                            src="images/slika2.jpg"
                            class="card-img-top img-fluid"
                            alt="pancakes"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content.
                        </p>
                        <a href="#" class="btn bg-orange text-cream">View</a>
                    </div>
                </div>
            </div>

            <div class="col-8 col-md-7 col-xl-4">
                <div class="card">
                    <img
                            src="images/Slika3.jpg"
                            class="card-img-top img-fluid"
                            alt="pancakes"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content.
                        </p>
                        <a href="#" class="btn bg-orange text-cream">View</a>
                    </div>
                </div>
            </div>

            <div class="col-8 col-md-7 col-xl-4">
                <div class="card">
                    <img
                            src="images/Slika4.jpg"
                            class="card-img-top img-fluid"
                            alt="pancakes"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content.
                        </p>
                        <a href="#" class="btn bg-orange text-cream">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
                fill="#E7E393"
                fill-opacity="1"
                d="M0,224L60,202.7C120,181,240,139,360,128C480,117,600,139,720,138.7C840,139,960,117,1080,96C1200,75,1320,53,1380,42.7L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
        ></path>
    </svg>
</section>


<script src="js/api.js"></script>

</body>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
></script>
<script src="js/main.js"></script>
</html>