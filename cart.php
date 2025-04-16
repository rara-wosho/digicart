<?php

  include "includes/includes.php";

  // redirect back the user to sign in page if not signed in 
  if(isset($_SESSION["current_user"])){

    $ownerId = $_SESSION["current_user"]['user_id'];
    $items = $cart->getCartProducts($connection, $ownerId);

  }else{
    header("location: signin.php");
    exit();
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
                class="nav-link text-uppercase fw-semibold px-4 text-center active"
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

    <div class="cart-page-wrapper">
      <div class="container mx-auto d-flex flex-column">
        <div class="d-flex align-items-center py-3">
          <div onclick="window.history.back()" class="bg-white border d-flex align-items-center rounded-circle me-3 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
          </div>
          <h3 class="mb-0">Your Cart<span class="fs-6 ms-4">Total : <?=$items->num_rows?></span></h3>

          <a href="products.php" class="btn border bg-accent btn-sm ms-auto"
            >Continue Browsing</a
          >
        </div>

        <table style="flex-grow: 1" class="product-table mb-4">
          <thead>
            <tr class="border-0">
              <th class="py-3">Image</th>
              <th class="py-3 px-3">Product Name</th>
              <th class="py-3 px-3">Category</th>
              <th class="py-3">Price</th>
              <th class="py-3">Quantity</th>
              <th class="py-3">Check Out</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $items->fetch_assoc()): ?>
              <tr>
                <td>
                  <img
                    src="<?= $row['image_path']?>"
                    alt=""
                    class="rounded-2"
                  />
                </td>
                <td class="product-name px-3">
                  <a href="product-details.php?id=<?= $row['product_id']?>" class="text-black fw-semibold">
                    <?= $row['name']?>
                  </a>
                </td>
                <td class="product-name px-3">
                  <?= $row['category']?>
                </td>
                <td>₱<?= $row['price']?></td>
                <td><?= $row['cart_quantity']?></td>
                <td>
                  <?php if($row['stock'] > 0){?>
                    <a href="check-out.php?product_id=<?= $row['product_id']?>&q=<?=$row['cart_quantity']?>" class="btn btn-sm btn-success">Check Out</a>
                  <?php }else{
                    echo "Out Of Stock";
                  } ?>
                </td>
                <td>
                  <a href="delete-from-cart-logic.php?product_id=<?= htmlspecialchars($row['product_id']) ?>&user_id=<?= htmlspecialchars($row['user_id']) ?>" 
                    class="btn d-inline-flex btn-outline-danger text-danger ms-auto remove-btn rounded-circle align-items-center"
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
                      class="lucide lucide-x-icon lucide-x"
                    >
                      <path d="M18 6 6 18" />
                      <path d="m6 6 12 12" />
                    </svg>
                  </a>
                </td>
              </tr>
            <?php endwhile ?>

            <?php
                if($items->num_rows == 0){
            ?>
              <!-- <div class="d-flex flex-column align-items-center justify-content-center p-5">
                  <img src="images/icons/empty-pana.png" width="160" height="160" alt="">
              </div> -->
            <?php
                }
            ?>
          </tbody>
        </table>
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
