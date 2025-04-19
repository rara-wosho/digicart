<?php
  include "includes/includes.php";

  $topSellers = $digiProduct->topProducts($connection, 4);
  $newProducts = $digiProduct->newProducts($connection, 4);

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

    <!-- hero-section  -->
    <section
      class="hero-section container d-flex flex-column align-items-start justify-content-center p-3 p-md-4"
    >
      <h1>Looking for a brand new smart phone?</h1>
      <h1 class="fw-bold text-uppercase hero-main-text text-primary w-75">Come… take a handpick and own</h1>
      <p class="subtitle fs-5 mb-0">
      Shop at iProTech Gadget Center 
      Facade of Aloran Business Center.
      </p>

      <div class="d-flex align-items-center mt-3 mb-3">
        <a href="products.php" class="btn bg-accent btn-sm py-2 px-4 shadow-sm fw-semibold me-2">Browse Products</a>

        <button class="btn btn-outline-secondary btn-sm py-2 px-4 fw-semibold">
          Learn More
        </button>
      </div>
    </section>

    <!-- category-sectionn  -->
    <section
      class="category-section bg-body-tertiary d-flex justify-content-center align-items-center"
    >
      <div style="transform:translateY(-2rem)" class="d-flex align-items-center-justify-content-center rounded-2 overflow-hidden shadow-sm">
        <div class="bg-primary p-4">
          <div class="d-flex align-items-center pe-5 border-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smartphone-icon lucide-smartphone"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
            <p class="mb-0 ms-1 text-white">Smartphones</p>
          </div>
        </div>
        <div class="bg-primary p-4">
          <div class="d-flex align-items-center pe-5 border-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tablet-smartphone-icon lucide-tablet-smartphone"><rect width="10" height="14" x="3" y="8" rx="2"/><path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4"/><path d="M8 18h.01"/></svg>
            <p class="mb-0 ms-1 text-white">Tablets</p>
          </div>
        </div>
        <div class="bg-primary p-4">
          <div class="d-flex align-items-center pe-5 border-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-laptop-minimal-icon lucide-laptop-minimal"><rect width="18" height="12" x="3" y="4" rx="2" ry="2"/><line x1="2" x2="22" y1="20" y2="20"/></svg>
            <p class="mb-0 ms-1 text-white">PC and Laptops</p>
          </div>
        </div>
        <div class="bg-primary py-4 ps-4">
          <div class="d-flex align-items-center pe-5 border-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-boom-box-icon lucide-boom-box"><path d="M4 9V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/><path d="M8 8v1"/><path d="M12 8v1"/><path d="M16 8v1"/><rect width="20" height="12" x="2" y="9" rx="2"/><circle cx="8" cy="15" r="2"/><circle cx="16" cy="15" r="2"/></svg>
            <p class="mb-0 ms-1 text-white">Speakers</p>
          </div>
        </div>
        <div class="bg-primary py-4 ps-4">
          <div class="d-flex align-items-center pe-5 ps-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-watch-icon lucide-watch"><circle cx="12" cy="12" r="6"/><polyline points="12 10 12 12 13 13"/><path d="m16.13 7.66-.81-4.05a2 2 0 0 0-2-1.61h-2.68a2 2 0 0 0-2 1.61l-.78 4.05"/><path d="m7.88 16.36.8 4a2 2 0 0 0 2 1.61h2.72a2 2 0 0 0 2-1.61l.81-4.05"/></svg>
            <p class="mb-0 ms-1 text-white">Smart Watch</p>
          </div>
        </div>
      </div>
    </section>

    <!-- services section  -->
    <div style="gap:32px" class="services-section pt-5 d-flex align-items-center bg-body-tertiary justify-content-center">
        <div class="left w-25">
          <img class="rounded-3" width="100%" src="https://i.pinimg.com/736x/d8/c8/06/d8c80615ce50ddced703b37c52b82c0a.jpg" alt="">
        </div>
        <div class="left d-flex flex-column w-25 align-items-start">
          <h2>Choose <span class="text-accent">The Best</span> Repair Service</h2>
          <p class="mb-3 py-3 text-muted">At iProtech, we do not just have quality products, we also offer fast, reliable, and affordable repairs for your essential devices. Whether it's a cracked phone screen or a slow laptop, we’re here to bring your gadgets back to life.</p>
          <div class="d-flex">
            <button class="btn btn-sm px-4 py-2 btn-secondary me-2 d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone me-2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              Call Us
            </button>
            <button class="btn btn-sm px-4 py-2 btn-outline-secondary d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail me-2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>Send an Email
          </button>
          </div>
        </div>
    </div>

    <!-- new product  -->
    <div
      style="padding-block:4.5rem"
      class="new-products-section bg-body-tertiary d-flex flex-column align-items-center justify-content-center"
    >
      <h2 class="mb-2 fw-bold">
        Our <span class="text-primary">Newest</span> Products
      </h2>
      <p class="text-muted mb-5">Check our lates and exciting products</p>
      <div
        style="gap: 12px"
        class="d-flex align-items-center justify-content-center container"
      >
        <?php while($row = $newProducts->fetch_assoc()):?>
          <a href="product-details.php?id=<?=$row['product_id']?>" class="card">
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
              src="<?=$row['image_path']?>"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h5 class="card-title text-truncate"><?=$row['name']?></h5>

              <p class="card-text text-truncate text-muted">
                <?=$row['description']?>
              </p>

              <div class="d-flex align-items-end justify-content-between">
                <h4 class="text-primary fw-bold">₱<?=$row['price']?></h4>
                <p class="mb-2 card-sold text-secondary"><?=$row['sold']?> sold</p>
              </div>
            </div>
          </a>
        <?php endwhile ?>
      </div>

      <a href="products.php" class="btn bg-accent fw-semibold mt-5"
        >View Products</a
      >
    </div>

    <!-- brands section  -->
    <div style="gap:12px; padding-bottom:4rem" class="d-flex align-items-center bg-body-tertiary">
      <div class="container mx-auto d-flex flex-column align-items-center">
        <img width="1190" src="images/promos.png" alt="">
      </div> 
    </div>

    <!-- TOP SELLERS  -->
    <div
      style="padding-bottom:5rem"
      class="new-products-section bg-body-tertiary d-flex flex-column align-items-center justify-content-center"
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
        <?php while($row = $topSellers->fetch_assoc()):?>
          <a href="product-details.php?id=<?=$row['product_id']?>" class="card">
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
              src="<?=$row['image_path']?>"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h5 class="card-title text-truncate"><?=$row['name']?></h5>

              <p class="card-text text-truncate text-muted">
                <?=$row['description']?>
              </p>

              <div class="d-flex align-items-end justify-content-between">
                <h4 class="text-primary fw-bold">₱<?=$row['price']?></h4>
                <p class="mb-2 card-sold text-secondary"><?=$row['sold']?> sold</p>
              </div>
            </div>
          </a>
        <?php endwhile ?>
      </div>

      <a href="products.php" class="btn bg-accent fw-semibold mt-5"
        >View Products</a
      >
    </div>

    <!-- brands section  -->
    <div style="gap:12px; padding-bottom:8rem" class="d-flex align-items-center bg-body-tertiary">
      <div class="container mx-auto d-flex flex-column align-items-center">
        <h4 class="text-muted mb-4">Shop by Brands</h4>
        <img width="1190" src="images/branfs.png" alt="">
      </div> 
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
      class="d-flex bg-body-tertiary"
    >
      <div class="container d-flex align-items-center justify-content-between py-5">
        <div>
          <h3 class="fw-bold mb-0 text-muted d-flex align-items-center">
            <img src="images/logo.png" width="40" height="40" alt="" />Digi<span
              class="text-primary"
              >Cart</span
            >
          </h3>
        </div>

        <div class="d-flex flex-column align-items-center">
          <h5 class="border-bottom pb-3 text-muted fw-bold">Get In Touch With Us</h5>
          <div style="gap:8px" class="d-flex align-items-center py-2">
            <div class="border p-2 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </div>

            <div class="border p-2 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>

            <div class="border p-2 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div class="border p-2 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
          </div>
        </div>

        <div class="">
          <p class="mb-0 fw-semibold text-secondary">All rights reserved</p>
        </div>
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
