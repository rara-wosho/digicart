<?php

  include "includes/includes.php";

  // check if  there is product id  and current user 
  if(isset($_GET['product_id']) && isset($_SESSION['current_user'])){
    $quantity = $_GET['q'] ?? 1;
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
                href="index.php"
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
                href="about.html"
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

    <div class="checkout-page container">
      <form id="checkoutForm" method="POST" action="confirm-payment-logic.php" style="gap:12px;" class="d-flex align-items-start justify-content-center mb-5">
        <div class="left p-5 bg-white shadow-sm rounded-3">
            <?php 
              if(isset($_SESSION['transaction_error'])){
                  echo '
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          ' . $_SESSION["transaction_error"] . '
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  ';

                  unset($_SESSION['transaction_error']);
              }
            ?>

          <div class="d-flex align-items-center mb-4">
            <div onclick="window.history.back()" class="bg-white border d-flex align-items-center rounded-circle me-3 p-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
            </div>
            <h3 class="mb-0">Check Out</h3>
          </div>
          <h5 class="mb-3 text-secondary">Product Details</h5>
          <div class="d-flex align-items-center border-top py-3">
            <input type="hidden" name="transac-product-id" value="<?=$product['product_id']?>" >
            <input type="hidden" name="transac-user-id" value="<?=$_SESSION['current_user']["user_id"]?>" >
            <input type="hidden" name="transac-price" value="<?=(int)$product['price']?>">
            <input type="hidden" name="cart_quantity" value="<?=(int)$quantity?>">
            <input type="hidden" name="" value="<?=(int)$product['price']?>">
            <input type="hidden" name="transac-total" value="<?=($product['price'] * (int)$quantity) + 50?>" >

            <img
              src="<?=$product['image_path']?>"
              class="rounded-2"
              width="90"
              height="90"
              style="object-fit: cover"
              alt=""
            />

            <input type="text" class="appearance-none fw-semibold ms-2 text-muted" name="transac-product-name" readonly value="<?=$product['name']?>">
            <p class="ms-auto fw-semibold mb-0">₱<?=$product['price']?></p>
          </div>

          <div style="background-color:rgba(92, 157, 248, 0.16);" class="p-3 rounded-1">
            <h5 class="text-muted mb-3">Order Summary</h5>
            <div
              class="d-flex justify-content-between align-items-center mt-2 mb-2"
            >
              <p class="text-muted mb-0">Quantity</p>
              <h6 class="mb-0 text-muted ms-auto">x<?=$quantity?></h6>
            </div>
            <div
              class="d-flex justify-content-between align-items-center mt-2 mb-2"
            >
              <p class="text-muted mb-0">Subtotal</p>
              <h6 class="mb-0 text-muted ms-auto">₱<?=$quantity * $product['price']?></h6>
            </div>
            <div
              class="d-flex justify-content-between align-items-center mt-2 mb-3"
            >
              <p class="text-muted mb-0">Shipping fee</p>
              <h6 class="mb-0 text-muted ms-auto">₱50</h6>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-1">
              <h6 class="fw-bold fs-4 text-primary">Total</h6>
              <h4 class="text-primary fw-bold">₱<?=($product['price'] *  $quantity) + 50?></h4>
            </div>
          </div>
        </div>
        <div class="right p-5 bg-white shadow-sm rounded-3">
          <h5 class="mb-4 text-secondary">Order Details</h5>
          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input
              required name="fullname"
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
              required name="address"
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
              required name='email'
              type="text"
              class="form-control bg-none"
              id="fullname"
              placeholder="name@example.com"
              value="<?=$_SESSION['current_user']['email']?>"
            />
          </div>

          <p class="mb-2">Payment Options</p>
          <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link py-0  active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                <label for="master-card">
                <input type="radio" required name="payment-option" id="master-card" value="master-card">
                  <img width="50" height="50" src="images/icons/card.png" alt="">
                </label>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link py-0 " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  <label for="paypal">
                  <input type="radio" required name="payment-option" id="paypal" value="paypal">
                    <img width="50" height="50" src="images/icons/paypal.png" alt="">
                  </label>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link py-0 " id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                  <label for="apple-pay">
                    <input type="radio" required name="payment-option" id="apple-pay" value="apple-pay">
                    <img width="50" height="50" src="images/icons/apple-pay.png" alt="">
                  </label>
              </button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              <div class="mb-3">
                <h6 class="mb-3">Master Card</h6>
                <label for="gcash" class="form-label">Card Holder Name</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder="Name on Card"
                />
              </div>
              <div class="mb-3">
                <label for="gcash" class="form-label">Card Number</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder="00-000-000-00"
                />
              </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              <div class="mb-3">
                <h6 class="mb-3">Paypal</h6>
                <label for="gcash" class="form-label">Paypal Number</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder=""
                />
              </div>
              <div class="mb-3">
                <label for="gcash" class="form-label">Registered Name</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder=""
                />
              </div>  
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
              <div class="mb-3">
                <h6 class="mb-3">Apple Pay</h6>
                <label for="gcash" class="form-label">Apple Pay Number</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder=""
                />
              </div>
              <div class="mb-3">
                <label for="gcash" class="form-label">Registered Name</label>
                <input
                  type="text"
                  class="form-control bg-none"
                  id="gcash"
                  placeholder=""
                />
              </div> 
            </div>
          </div>

          <button
            class="bg-accent fw-semibold w-100 text-center border-0 py-2 mt-3 rounded-2"
          >
            Confirm Order
          </button>
        </div>
      </form>
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get the modal instance
      var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
      
      // Show the modal automatically
      myModal.show();
    });
  </script>
</html>
