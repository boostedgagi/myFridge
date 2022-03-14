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
                <li class="nav-item">
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