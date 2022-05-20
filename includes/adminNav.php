<nav class="navbar navbar-expand-md nav-light">
        <div class="container-xxl">
            <a href="../index.php" class="navbar-brand">
                <span class="fw-bold text-black"> Administrator </span>
            </a>
            <!-- Nav for mobile -->
            <button
                class="navbar-toggler bg-light"
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
                    <li class="nav-item dropdown ms-1">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Recipes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Categories</a></li>
                            <li><a class="dropdown-item" href="#">Edit recipes</a></li>
                            <li><a class="dropdown-item" href="#">Approve recipes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-1">
                        <a href="#" class="nav-link text-black">Users</a>
                    </li>
                    <li class="nav-item ms-1">
                        <a href="adminGroceries.php" class="nav-link text-black">Groceries</a>
                    </li>
                    <li class="nav-item ms-1">
                        <a href="#" class="nav-link text-black">Comments</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
