<?php
  include "includes/includes.php";


  if(isset($_GET['id'])){
    // get product id from url 
    $productId = $_GET['id'];

    // if product id exist, get the specific product 
    $product = $digiProduct->getProductById($connection, $productId);

    // declare the variable
    $inCart = false;

    // add the item to cart if add button is clicked 
    if(isset($_POST['add-to-cart-btn'])){
      // if user is  signed in, add the item to cart
      if(isset($_SESSION['current_user'])){
        // the current user's id 
        $ownerID  = $_SESSION['current_user']['user_id'];
        $quantity = $_POST['quantity'];
        $cart->addToCart($connection, $ownerID, $productId, $quantity);
      }else{
        header("location: signin.php");
        exit();
      }

    }

    if(isset($_SESSION['current_user'])){
      // reassign a value if item is in cart 
      $inCart = $cart->isInCart($connection, $_SESSION['current_user']['user_id'], $productId);
    }


  }else{
    // if no product id, redirect back to products 
    header("location: products.php");
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

    <div class="product-details-page">

      <!-- PRODUCT IMAGE  -->
      <div class="row row-cols-2 mb-3 pt-4">
        <div class="col">
            <button onclick="window.location.href = 'products.php'" class="btn border rounded-circle btn-sm position-absolute bg-white shadow-sm d-flex align-items-center justify-content-center py-2"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg></button>
          <img
            style="aspect-ratio: 5/4; object-fit: contain"
            src="<?= $product['image_path']?>"
            width="100%"
            class="product-details-img"
          />
        </div>

        <div class="col">
          <div class="details d-flex flex-column ps-3">
            <h3><?= $product['name']?></h3>
            <h5 class="text-primary py-2">₱<?= $product['price']?></h5>

            <div class="d-flex mb-2 align-items-center">
              <p class="mb-0 text-secondary">Sold : <?= $product['sold']?></p>
              <p class="mb-0  ms-4 text-secondary">Stocks : <?= $product['stock']?></p>
            </div>

            <?php
              if($product['stock'] > 0){
            ?>
              <!-- form  -->
              <form method="POST" class="my-3">
                <div class="d-flex align-items-center mb-3">
                  <button id="minus-btn" type="button" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus"><path d="M5 12h14"/></svg>
                  </button>
                    <input readonly type="number" name="quantity" id="quantity-value" class="appearance-none text-center mx-1 fs-5 text-muted fw-semibold" style="width:50px;"  value="1">
                  <button id="plus-btn" type="button" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  </button>
                </div>

                <button
                  type="submit"
                  name="add-to-cart-btn"
                  class="btn border py-2 px-3 bg-black text-white fw-semibold"
                  <?= $inCart ? 'disabled' : '' ?>
                >

                  <?= $inCart ? "Added to Cart" : "Add to Cart" ?>
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
                    class="lucide lucide-shopping-cart-icon lucide-shopping-cart ms-2"
                  >
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path
                      d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"
                    />
                  </svg>
                </button>

                <a href="check-out.php?product_id=<?= $product['product_id']?>" class="btn btn-outline-secondary py-2 px-3 ms-2">
                  Buy Now
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
                    class="lucide lucide-hand-coins-icon lucide-hand-coins ms-2"
                  >
                    <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                    <path
                      d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"
                    />
                    <path d="m2 16 6 6" />
                    <circle cx="16" cy="9" r="2.9" />
                    <circle cx="6" cy="5" r="3" />
                  </svg>
                </a>
              </form>
            <?php
              }else{
                echo '<p class="mb-3 alert alert-danger">Out of Stock</p>';
              }
            ?>

            <div class="d-flex align-items-center">
              <h6 class="mb-0 me-2">Category </h6>
              <p class="px-3 mb-0 py-2 rounded-1 border d-inline-block">
              <?= $product['category']?>
              </p>
            </div>

            <p class="mt-3">
              <?= $product['description']?>
            </p>
          </div>
        </div>
      </div>

      <!-- tab section  -->
      <div class="d-flex justify-content-center border-bottom border-top">
        <p class="mb-0 text-black py-3 text-uppercase text-primary px-4">
          Description
        </p>
        <p class="mb-0 text-secondary py-3 text-uppercase text-primary px-4">
          Product Details
        </p>
        <p class="mb-0 text-secondary py-3 text-uppercase text-primary px-4">
          Reviews
        </p>
      </div>

      <div class="content py-3">
        <p>
        <?= $product['description']?>
        </p>
      </div>
    </div>

    <!-- suggestion section  -->
    <h3 class="text-center pt-5 mb-4">Products you might like</h3>
    <div
      style="gap: 12px"
      class="d-flex align-items-center justify-content-center container mb-5"
    >
      <div class="card">
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
          src="https://i.pinimg.com/736x/41/03/69/410369e27a28da5f48b9644d90e5f133.jpg"
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
      </div>
      <div class="card">
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
          src="https://i.pinimg.com/736x/41/03/69/410369e27a28da5f48b9644d90e5f133.jpg"
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
      </div>
      <div class="card">
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
          src="https://i.pinimg.com/736x/41/03/69/410369e27a28da5f48b9644d90e5f133.jpg"
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
      </div>
      <div class="card">
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
          src="https://i.pinimg.com/736x/41/03/69/410369e27a28da5f48b9644d90e5f133.jpg"
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
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script>
      const quantityInput = document.getElementById("quantity-value");
      let quantity = parseInt(quantityInput.value);

      const stock = <?=$product['stock']?>;

      document.getElementById("minus-btn").addEventListener('click', function(){
        if(quantity > 1){
          quantity -= 1;
          quantityInput.value = quantity;
        }
      })
      
      document.getElementById("plus-btn").addEventListener('click', function(){
        if(quantity < stock){
          quantity += 1;
          quantityInput.value = quantity;
        }
      })
    </script>
  </body>
</html>
