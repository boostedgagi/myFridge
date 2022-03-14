<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/login.php";
include "includes/register.php";
?>

    <!-- TOP -->
    <section id="top">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 text-center text-md-start">

                        <div class="display-2 text-black">MyFridge</div>
                        <div class="display-5 text-brown">
                            Lorem ipsum dolor sit amet.
                        </div>

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

    <section id="review" class="bg-cream">
        <div class="container my-5">
            <div class="row">
                <div class="col-6">
                    <h1>Reviews</h1>
                </div>
                <div class="col-6 text-end mb-3">
                    <button class="bg-orange text-center rounded-circle border-1 p-2" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                        </svg>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="bg-orange text-center rounded-circle border-1 p-2" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">
                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">
                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="images/profile.jpg" width="100px" height="100px"
                                         class="rounded-circle mt-5 ms-3" alt="profile-picture">

                                    <div class="card-body">
                                        <div class="mt-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="card-title">
                                            <h3 class="text-black">Hello</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>Lorem ipsum dolor sit amet.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

<!-- FOOTER -->
    <section id="footer" class="bg-yellow">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#E7E393" fill-opacity="1"
                  d="M0,192L120,165.3C240,139,480,85,720,85.3C960,85,1200,139,1320,165.3L1440,192L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path>
        </svg>
        <div class="container-lg">
            <div class="row text-center align-content-center">
                <div class="col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                         class="bi bi-facebook" viewBox="0 0 16 16" onclick="location.href = '#';"
                         style="cursor: pointer">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                         class="bi bi-instagram mx-3" viewBox="0 0 16 16" onclick="location.href = '#';"
                         style="cursor: pointer">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg>


                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                         class="bi bi-twitter" viewBox="0 0 16 16" onclick="location.href = '#';"
                         style="cursor: pointer">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>

                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col-12">
                    <p class="text-black m-0">Contact us</p>
                </div>
                <div class="col-12">
                    <small class="text-brown">&copy; 2022 Dragan and David</small>
                </div>
            </div>
        </div>
        <div class="logo text-end">
            <img src="images/fridge2.png" alt="logo" width="50px" height="50px" onclick="location.href = '#';">
        </div>
    </section>
<?php
include "includes/footer.php";
?>