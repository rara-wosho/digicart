<?php
  include "includes/includes.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DigiCart</title>
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
                echo('<a class="mb-0 d-flex align-items-center" href="profile.php"><img class="me-2" width="32"  height="32" src="images/icons/user.png" alt="">'.$_SESSION['current_user']['firstname'].'</a>');
              }else{
                echo('<a href="signin.php" class="btn btn-primary">Sign In</a>');
              }
            ?>
          </div>
        </div>
      </div>
    </nav>

    <!-- hero-section  -->
    <section
      class="hero-section container d-flex flex-column align-items-start justify-content-center p-3 p-md-4"
    >
      <h3>Instant Digital Downloads, Zero Wait</h3>

      <h1 class="hero-main-text text-muted fw-bold mt-1">Get premium</h1>

      <h1 class="text-primary fw-bold mb-3 text-uppercase hero-main-text">
        Digital Products
      </h1>
      <p class="subtitle">
        Delivered automatically after payment. No shipping, no hassle.
      </p>

      <div class="d-flex align-items-center mt-3">
        <button class="btn btn-outline-secondary fw-semibold">
          Learn More
        </button>
        <a href="products.php" class="btn bg-accent fw-semibold ms-2">Browse Products</a>
      </div>
    </section>

    <!-- category-sectionn  -->
    <section
      class="category-section bg-body-tertiary d-flex flex-column justify-content-center align-items-center"
    >
      <h3 class="mb-3">Categories</h3>
      <p class="text-muted mb-4">
        Which type of digital product are you looking for?
      </p>
      <div class="category-wrapper d-flex align-items-center">
        <div
          class="py-4 px-4 rounded-2 mx-2 category-card border d-flex justify-content-center flex-column align-items-center"
        >
          <img width="50" height="50" src="images/icons/windows.png" alt="" />
          <h4 class="mb-0 mt-2">Templates</h4>
          <p class="mb-0 text-secondary mt-2">58</p>
        </div>
        <div
          class="py-4 px-4 rounded-2 mx-2 category-card border d-flex justify-content-center flex-column align-items-center"
        >
          <img
            width="50"
            height="50"
            src="images/icons/digital-library.png"
            alt=""
          />
          <h4 class="mb-0 mt-2">eBooks</h4>
          <p class="mb-0 text-secondary mt-2">68</p>
        </div>
        <div
          class="py-4 px-4 rounded-2 mx-2 category-card border d-flex justify-content-center flex-column align-items-center"
        >
          <img width="50" height="50" src="images/icons/computer.png" alt="" />
          <h4 class="mb-0 mt-2">Tools</h4>
          <p class="mb-0 text-secondary mt-2">34</p>
        </div>
        <div
          class="py-4 px-4 rounded-2 mx-2 category-card border d-flex justify-content-center flex-column align-items-center"
        >
          <img width="50" height="50" src="images/icons/boy.png" alt="" />
          <h4 class="mb-0 mt-2">For Kids</h4>
          <p class="mb-0 text-secondary mt-2">29</p>
        </div>
      </div>
    </section>

    <!-- new product  -->
    <div
      class="new-products-section bg-body-tertiary section-padding d-flex flex-column align-items-center justify-content-center"
    >
      <h2 class="mb-2 fw-bold">
        Our <span class="text-primary">Newest</span> Products
      </h2>
      <p class="text-muted mb-5">Check our lates and exciting products</p>
      <div
        style="gap: 12px"
        class="d-flex align-items-center justify-content-center container"
      >
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
      </div>

      <a href="products.html" class="btn bg-accent fw-semibold mt-5"
        >View Products</a
      >
    </div>

    <!-- TOP SELLERS  -->
    <div
      class="new-products-section bg-body-tertiary section-padding d-flex flex-column align-items-center justify-content-center"
    >
      <h2 class="mb-2 fw-bold">
        Top <span class="text-primary">Seller</span> Products
      </h2>
      <p class="text-muted mb-5">
        These are the top picks from our valued customers
      </p>
      <div
        style="gap: 12px"
        class="d-flex align-items-center justify-content-center container"
      >
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
        <a href="product-details.html?id=15" class="card">
          <div
            class="card-ratings d-flex align-items-center bg-white shadow-sm py-1 px-2 rounded-1"
          >
            <p class="mb-0 me-1 fw-semibold">20</p>
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
            src="https://i.pinimg.com/736x/47/66/4c/47664c7112e219e07608fcaf48c23d19.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title text-truncate">Card title</h5>

            <p class="card-text text-truncate text-muted">
              Some quick example text to build on the card title and make up the
              bulk of the card's content.
            </p>

            <div class="d-flex align-items-end justify-content-between">
              <h4 class="text-primary fw-bold">₱399</h4>
              <p class="mb-2 card-sold text-secondary">233 sold</p>
            </div>
          </div>
        </a>
      </div>

      <a href="products.html" class="btn bg-accent fw-semibold mt-5"
        >View Products</a
      >
    </div>

    <!-- customer feedback  -->
    <div
      class="customer-feedback py-5 flex-column text-center d-flex align-items-center justify-content-center text-white fs-1"
    >
      <p class="fw-bold">What Our Customers Say To Us</p>
      <div style="gap: 12px" class="d-flex align-items-center">
        <div
          class="feedback-card p-5 border rounded-2 d-flex flex-column align-items-start justify-content-center"
        >
          <div class="d-flex align-items-center mb-3">
            <img
              src="https://i.pinimg.com/736x/eb/76/a4/eb76a46ab920d056b02d203ca95e9a22.jpg"
              width="50"
              height="50"
              alt=""
              class="rounded-circle"
            />
            <h5 class="mb-0 ms-2">Random User</h5>
          </div>
          <p
            class="mb-0 text-secondary feedback-text fs-6 text-white text-start"
          >
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non ipsam
            repudiandae magni impedit tenetur molestiae?
          </p>
          <p class="mb-0 mt-3 fs-5 d-flex align-items-center">
            5/5
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-star-icon lucide-star ms-2"
            >
              <path
                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
              />
            </svg>
          </p>
        </div>
        <div
          class="feedback-card p-5 border rounded-2 d-flex flex-column align-items-start justify-content-center"
        >
          <div class="d-flex align-items-center mb-3">
            <img
              src="https://i.pinimg.com/736x/eb/76/a4/eb76a46ab920d056b02d203ca95e9a22.jpg"
              width="50"
              height="50"
              alt=""
              class="rounded-circle"
            />
            <h5 class="mb-0 ms-2">Random User</h5>
          </div>
          <p
            class="mb-0 text-secondary feedback-text fs-6 text-white text-start"
          >
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non ipsam
            repudiandae magni impedit tenetur molestiae?
          </p>
          <p class="mb-0 mt-3 fs-5 d-flex align-items-center">
            5/5
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-star-icon lucide-star ms-2"
            >
              <path
                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
              />
            </svg>
          </p>
        </div>
        <div
          class="feedback-card p-5 border rounded-2 d-flex flex-column align-items-start justify-content-center"
        >
          <div class="d-flex align-items-center mb-3">
            <img
              src="https://i.pinimg.com/736x/eb/76/a4/eb76a46ab920d056b02d203ca95e9a22.jpg"
              width="50"
              height="50"
              alt=""
              class="rounded-circle"
            />
            <h5 class="mb-0 ms-2">Random User</h5>
          </div>
          <p
            class="mb-0 text-secondary feedback-text fs-6 text-white text-start"
          >
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non ipsam
            repudiandae magni impedit tenetur molestiae?
          </p>
          <p class="mb-0 mt-3 fs-5 d-flex align-items-center">
            5/5
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-star-icon lucide-star ms-2"
            >
              <path
                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
              />
            </svg>
          </p>
        </div>
      </div>
    </div>

    <!-- FOOTER  -->
    <footer
      class="py-4 d-flex align-items-center justify-content-center bg-body-tertiary"
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
