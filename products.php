<?php

  include "includes/includes.php";

  // get all products 

  // category parameter is optional 
  $products = $digiProduct->getAllProducts($connection);
  
  if($_SERVER['REQUEST_METHOD'] = "GET"){
    if(isset($_GET['category'])){
      $products = $digiProduct->getAllProducts($connection, $_GET['category']);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="hasBG">
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
                class="nav-link text-uppercase fw-semibold px-4 text-center active"
                href="#"
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
                href="#"
                >Contact Us</a
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
                echo('<a href="profile.php"><img width="32"  height="32" src="images/icons/user.png" alt=""></a>');
              }else{
                echo('<a href="signin.php" class="btn btn-primary">Sign In</a>');
              }
            ?>
          </div>
        </div>
      </div>
    </nav>

    <!-- PRODUCT HEADER  -->
    <div
      style="margin-top: 5rem"
      class="product-header p-5 d-flex flex-column align-items-center"
    >
      <h1 class="fw-semibold">Products</h1>
      <p class="mb-0 text-center">Home / Product</p>
    </div>

    <div
      class="product-main-wrapper bg-body-tertiary d-flex flex-column align-items-center"
    >
      <!-- CATEGORY FORM  -->
      <form
        action=""
        method="GET"
        class="category-form mb-3 d-flex flex-column w-100 container px-4 pt-5 pb-3"
      >
        <h3>Choose Category</h3>

        <div class="categ-btns d-flex">
          <button type="submit" name="category" value="all"  style="font-size:14px" class="border  btn-secondary btn rounded-1 py-1 px-3 me-2">
            All
          </button>
          <button type="submit" value="Templates" name="category" style="font-size:14px" class="border  rounded-1 py-1 px-3 me-2 bg-body-tertiary">
            Templates
          </button>
          <button type="submit" value="E-books" name="category" style="font-size:14px" class="border  rounded-1 py-1 px-3 me-2 bg-body-tertiary">
            E-books
          </button>
          <button type="submit" value="Digital Art" name="category" style="font-size:14px" class="border  rounded-1 py-1 px-3 me-2 bg-body-tertiary">
            Digital Art
          </button>
          <button type="submit" value="For Kids" name="category" style="font-size:14px" class="border  rounded-1 py-1 px-3 me-2 bg-body-tertiary">
            For Kids
          </button>
          <button type="submit" value="Courses" name="category" style="font-size:14px" class="border  rounded-1 py-1 px-3 me-2 bg-body-tertiary">
            Courses
          </button>
        </div>
      </form>

      <!-- PRODUCT ROWS  -->
      <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 container">
        <?php while ($row = $products->fetch_assoc()): ?>
          <div class="col">
            <a href="product-details.php?id=<?=$row['product_id']?>" class="card">
              <div
                class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
              >
                <p class="mb-0 me-1 fw-semibold"><?= $row['ratings']?></p>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="13"
                  height="13"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="orange"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="lucide lucide-star-icon lucide-star"
                >
                  <path
                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
                  />
                </svg>
              </div>
              <img
                src="<?= $row['image_path']?>"
                class="card-img-top"
                alt="..."
              />
              <div class="card-body">
                <h5 class="card-title text-truncate"><?= $row['name']?></h5>

                <p class="card-text text-truncate text-muted">
                <?= $row['description']?>
                </p>

                <div class="d-flex align-items-end justify-content-between">
                  <h4 class="text-primary fw-bold">₱<?= $row['price']?></h4>
                  <p class="mb-2 card-sold text-secondary"><?= $row['sold']?> sold</p>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile ?>

        <?php
          if($products->num_rows <= 0){
        ?>
          <div class="d-flex flex-column align-items-center justify-content-center p-5 w-100">
            <h4 class="text-secondary">Whoops!</h4>
            <p class="text-secondary">It's empty in here.</p>
            <img width="250" height="250" src="images/icons/empty-pana.png" alt="">
          </div>
        <?php
          }
        ?>
      </div>
    </div>

    <!-- FOOTER  -->
    <footer
      class="py-4 d-flex align-items-center justify-content-center bg-white border-top"
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
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
