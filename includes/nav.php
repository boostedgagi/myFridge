<?php
session_start();
?>
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-xxl">
        <a href="index.php" class="navbar-brand">
            <span class="fw-bold text-black"> MyFridge </span>
        </a>
        <!-- Nav for mobile -->
        <button
                class="navbar-toggler bg-yellow"
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
                    <a href="index.php" class="nav-link text-black">Home</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="fridges.php" class="nav-link text-black">Fridges</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="recipes.php" class="nav-link text-black">Recipes</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="roommates.php" class="nav-link text-black">Roommates</a>
                </li>
                
                <!--li class="nav-item d-inline d-md-none ms-1">
                    <a
                            href="#"
                            class="nav-link btn text-black"
                            data-bs-toggle="modal"
                            data-bs-target="#loginmodal">
                        LogIn
                    </a>
                </li-->
                <?php
                if(!isset($_SESSION["userEmail"])){
                ?>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a
                            href="#"
                            class="nav-link btn bg-orange text-cream"
                            data-bs-toggle="modal"
                            data-bs-target="#loginmodal">
                        LogIn
                    </a>
                </li>
                <?php
                }
                else{
                ?>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a
                            href="includes/logout.php"
                            class="nav-link btn bg-orange text-cream">
                        Logout
                    </a>
                </li>
                <?php
                }
                ?>
                <?php
                    if(!isset($_SESSION["accountType"])){
                ?>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a
                            href="#"
                            class="nav-link btn bg-orange text-cream"
                            data-bs-toggle="modal"
                            data-bs-target="#registermodal">
                        Register
                    </a>
                </li>
                <?php
                }
                else if(isset($_SESSION["accountType"]) and $_SESSION["accountType"]==="user"){
                ?>
                    <li class="nav-item d-none d-md-inline ms-1">
                        <a href="user.php"
                           class="nav-link btn bg-orange text-cream">
                            <?php echo $_SESSION["userFirstName"]."'s profile" ?>
                        </a>
                    </li>
                <?php
                }
                else{
                ?>
                <li class="nav-item d-none d-md-inline ms-1">
                    <a href="admin.php"
                       class="nav-link btn bg-orange text-cream">
                        <?php echo "Admin page"; ?>
                    </a>
                </li>
                    <?php
                }
                ?>
                
            </ul>
        </div>
    </div>
</nav>