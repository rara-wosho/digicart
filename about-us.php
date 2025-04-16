<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>About DigiCart</title>
        <link rel="icon" href="images/logo.png" type="image/x-icon" />
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
        />

        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <!-- navbar  -->
        <nav class="navbar navbar-expand-lg shadow-sm bg-body-tertiary fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand d-flex align-items-center fw-bold" href="#"
            ><img
                src="images/logo.png"
                class="me-2"    
                width="50"
                height="50"
                alt=""
            />
            Digi<span class="text-primary">Cart</span>
            </a>
            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a
                    class="nav-link text-uppercase fw-semibold px-4 text-center active"
                    aria-current="page"
                    href=""
                    >Home</a
                >
                </li>
                <li class="nav-item">
                <a
                    class="nav-link text-uppercase fw-semibold px-4 text-center"
                    href="products.php"
                    >Products</a
                >
                </li>
                <li class="nav-item">
                <a
                    class="nav-link text-uppercase fw-semibold px-4 text-center"
                    href="#"
                    >About</a
                >
                </li>
                <li class="nav-item">
                <a
                    class="nav-link text-uppercase fw-semibold px-4 text-center"
                    href="orders.php"
                    >Orders</a
                >
                </li>
                <li class="nav-item">
                <a
                    class="nav-link text-uppercase fw-semibold px-4 text-center btn"
                    href="cart.php"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-shopping-cart-icon lucide-shopping-cart"
                    >
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path
                        d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"
                    />
                    </svg>
                </a>
                </li>
            </ul>
            <div class="d-flex justify-content-center ms-3">
                <?php
                if(isset($_SESSION['current_user'])){
                    echo('<a class="mb-0 d-flex align-items-center" href="profile.php"><img class="me-2" width="32"  height="32" src="images/icons/user.png" alt="">'.$_SESSION['current_user']['firstname'].'</a>');
                }else{
                    echo('<a href="signin.php" class="btn btn-primary">Sign In</a>');
                }
                ?>
            </div>
            </div>
        </div>
        </nav>
    </body>
    <!-- bootstrap cdn -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
</html>
