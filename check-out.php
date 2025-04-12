<?php

  include "includes/includes.php";

  // check if  there is product id  and current user 
  if(isset($_GET['product_id']) && isset($_SESSION['current_user'])){
    $product = $digiProduct->getProductById($connection, $_GET['product_id']);
  }else{
    // if not sign in, redirect back to signin page 
    header("location: signin.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Check Out</title>
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
        <a class="navbar-brand d-flex align-items-center fw-bold" href="#"
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
                class="nav-link text-uppercase fw-semibold px-4 text-center"
                aria-current="page"
                href="index.html"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-uppercase fw-semibold px-4 text-center"
                href="products.html"
                >Products</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-uppercase fw-semibold px-4 text-center"
                href="about.html"
                >About</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-uppercase fw-semibold px-4 text-center"
                href="#contact-us"
                >Contact Us</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-uppercase fw-semibold px-4 text-center btn"
                href="cart.html"
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
            <a href="signin.html" class="btn btn-primary">Sign In</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="checkout-page container">
      <div class="d-flex flex-column py-3">
        <h3>Check Out</h3>
      </div>

      <div class="d-flex align-items-start justify-content-center mb-5">
        <div class="left pe-5">
          <h5 class="mb-4 text-secondary">Product Details</h5>
          <div class="d-flex align-items-center border-top py-3 border-bottom">
            <img
              src="<?=$product['image_path']?>"
              class="rounded-2"
              width="90"
              height="90"
              style="object-fit: cover"
              alt=""
            />

            <h6 class="ms-3 mb-0"><?=$product['name']?></h6>
            <h6 class="text-primary ms-auto">₱339</h6>
          </div>

          <p class="text-muted py-3 border-bottom"><?=$product['description']?></p>

          <div
            class="d-flex align-items-center justify-content-between mt-5 mb-2"
          >
            <h6 class="">Subtotal</h6>
            <h6 class="">₱<?=$product['price']?></h6>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-bold">Total</h6>
            <h6 class="text-primary fw-bold">₱<?=$product['price']?></h6>
          </div>
        </div>
        <div class="right pe-5">
          <h5 class="mb-4 text-secondary">Order Details</h5>

          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input
              type="text"
              class="form-control bg-none"
              id="fullname"
              placeholder="name@example.com"
              value="<?=$_SESSION['current_user']['firstname']?> <?=$_SESSION['current_user']['lastname']?>"
            />
          </div>
          <div class="mb-3">
            <label for="fullname" class="form-label">Address</label>
            <input
              type="text"
              class="form-control bg-none"
              id="fullname"
              placeholder="name@example.com"
              value="<?=$_SESSION['current_user']['barangay']?>, <?=$_SESSION['current_user']['municipality']?>, <?=$_SESSION['current_user']['province']?>"
            />
          </div>
          <div class="mb-3">
            <label for="fullname" class="form-label">Email</label>
            <input
              type="text"
              class="form-control bg-none"
              id="fullname"
              placeholder="name@example.com"
              value="<?=$_SESSION['current_user']['email']?>"
            />
          </div>

          <p class="mb-2">Payment Options</p>
          <div
            style="gap: 8px; flex-wrap: wrap"
            class="d-flex align-items-center"
          >
            <div class="d-flex px-3 py-2 border rounded-1">
              <p class="mb-0">Credit Card</p>
            </div>
            <div class="d-flex px-3 py-2 border rounded-1">
              <p class="mb-0">Paypal</p>
            </div>
            <div class="d-flex px-3 py-2 border rounded-1">
              <p class="mb-0">Gcash</p>
            </div>
            <div class="d-flex px-3 py-2 border rounded-1">
              <p class="mb-0">Bank Transfer</p>
            </div>
            <div class="d-flex px-3 py-2 border rounded-1">
              <p class="mb-0">Digital Wallet</p>
            </div>
          </div>

          <button
            class="bg-accent fw-semibold w-100 text-center border-0 py-2 mt-3 rounded-2"
          >
            Purchase Now ₱<?=$product['price']?>
          </button>
        </div>
      </div>
    </div>

    <!-- FOOTER  -->
    <footer
      class="py-4 d-flex align-items-center justify-content-center bg-white"
    >
      <div class="container d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-muted d-flex align-items-center">
          <img src="images/logo.png" width="50" height="50" alt="" />Digi<span
            class="text-primary"
            >Cart</span
          >
        </h3>
        <p class="mb-0 text-secondary fw-bold">Mherafe Cabug@2025</p>
      </div>
    </footer>

    <!-- bootstrap cdn -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
