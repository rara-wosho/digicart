<?php

  include "includes/includes.php";


  // get all products
  $products = $digiProduct->getAllProducts($connection);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="style.css" />

    <!-- JQUERY CDN -->
    <script
      src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="admin-dashboard-page expand-sidebar">
      <!-- SIDEBAR  -->
      <div
        class="sidebar border-end bg-white shadow-sm px-2 d-flex flex-column pb-3"
      >
        <div class="sidebar-header border-bottom mb-4 py-3 d-flex align-items-center">
          <img
            width="45"
            height="45"
            src="images/logo.png"
            alt=""
            class="ms-1"
          />
          <p class="mb-0 sidebar-label fw-bold fs-5">
            Digi<span class="text-primary">Cart</span>
          </p>
        </div>

        <ul class="p-0 border-bottom">
          <li class="">
            <a href="admin_dashboard.php" class="">
              <div
                class="sidebar-icon d-flex align-items-center justify-content-center"
              >
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
                  class="lucide lucide-house-icon lucide-house"
                >
                  <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                  <path
                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                  />
                </svg>
              </div>
              <p class="sidebar-label mb-0 px-2">Home</p>
            </a>
          </li>
          <li class="">
            <a href="manage_orders.html" class="">
              <div
                class="sidebar-icon d-flex align-items-center justify-content-center"
              >
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
                  class="lucide lucide-shopping-basket-icon lucide-shopping-basket"
                >
                  <path d="m15 11-1 9" />
                  <path d="m19 11-4-7" />
                  <path d="M2 11h20" />
                  <path
                    d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"
                  />
                  <path d="M4.5 15.5h15" />
                  <path d="m5 11 4-7" />
                  <path d="m9 11 1 9" />
                </svg>
              </div>
              <p class="sidebar-label mb-0 px-2">Orders</p>
            </a>
          </li>
          <li class="">
            <a href="manage_users.html" class="">
              <div
                class="sidebar-icon d-flex align-items-center justify-content-center"
              >
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
                  class="lucide lucide-user-round-icon lucide-user-round"
                >
                  <circle cx="12" cy="8" r="5" />
                  <path d="M20 21a8 8 0 0 0-16 0" />
                </svg>
              </div>
              <p class="sidebar-label mb-0 px-2">User Management</p>
            </a>
          </li>
          <li class="active">
            <a href="" class="">
              <div
                class="sidebar-icon d-flex align-items-center justify-content-center"
              >
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
                  class="lucide lucide-package-icon lucide-package"
                >
                  <path
                    d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"
                  />
                  <path d="M12 22V12" />
                  <polyline points="3.29 7 12 12 20.71 7" />
                  <path d="m7.5 4.27 9 5.15" />
                </svg>
              </div>
              <p class="sidebar-label mb-0 px-2">Product Management</p>
            </a>
          </li>
        </ul>

        <a style="background-color:rgb(240,240,245)" href="" class="rounded-3 d-flex  align-items-center text-black py-2 px-3"
          ><div class="sidebar-icon">
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
              class="lucide lucide-log-out-icon lucide-log-out text-danger"
            >
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
              <polyline points="16 17 21 12 16 7" />
              <line x1="21" x2="9" y1="12" y2="12" />
            </svg>
          </div>
          <p class="sidebar-label mb-0 text-danger">Log Out</p></a
        >
      </div>

      <!-- dashboard header  -->
      <div
        class="dashboard-header shadow-sm bg-white py-3 d-flex align-items-center justify-content-between ps-2 pe-5"
      >
        <div class="d-flex align-items-center">
          <button class="sidebar-toggle btn">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-columns2-icon lucide-columns-2"
            >
              <rect width="18" height="18" x="3" y="3" rx="2" />
              <path d="M12 3v18" />
            </svg>
          </button>
          <h4 class="mb-0">Product Management</h4>
        </div>

        <div class="d-flex align-items-center">
          <img
            width="30"
            height="30"
            src="images/icons/boy.png"
            alt=""
            class="rounded-circle"
          />

          <p class="mb-0 ms-2 fw-semibold"><?=$_SESSION['current_user']['firstname']?></p>
        </div>
      </div>

      <!-- main content  -->
      <div class="bg-white p-4 shadow-sm rounded-2 m-3 pe-4">
          <!-- feedback message for adding product  -->
          <?php 
              if(isset($_SESSION['add_product_error'])){
                  echo '
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          ' . $_SESSION["add_product_error"] . '
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  ';
  
                  unset($_SESSION['add_product_error']);
              }
              if(isset($_SESSION['add_product_success'])){
                  echo '
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          ' . $_SESSION["add_product_success"] . '
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  ';
  
                  unset($_SESSION['add_product_success']);
              }
          ?>

        <!-- product page header  -->
        <div class="d-flex align-items-center justify-content-between mt-1">
          <h5 class="text-primary mb-0">Total Products: <?= $products->num_rows?></h5>
          <!-- Button trigger modal -->
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            Add New Product
          </button>
        </div>

        
        <!-- table for product list  -->
        <table class="table mt-4 admin-product-list-table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col">Sold</th>
              <th scope="col">Ratings</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $count = 1;
              while ($row = $products->fetch_assoc()){
            ?>

            
              <tr>
                <td><?=$count++?>.</td>
                <td>
                  <img style="object-fit:cover;" class="rounded-2" src="<?= $row['image_path']?>" width="50" height="50" alt="">
                </td>
                <td style="max-width:300px;"><?= $row['name'] ?></td>
                <td style="max-width:300px;"><?= $row['description'] ?></td>
                <td class="px-4">₱<?= $row['price'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['sold'] ?></td>
                <td><?= $row['ratings'] ?></td>
                <td>
                  <div style="12px" class="d-flex align-items-center">
                    <a href="" class="btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                    </a>
                    <a href="" class="btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </a>
                  </div>
                </td>
              </tr>
        
            <?php } ?>
          </tbody>
        </table>

      </div>

      <!-- MODAL FOR ADDING PRODUCT  -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content p-0 border-0">
            
            <div class="modal-header p-4 bg-primary">
              <h1 class="modal-title fs-4 text-white" id="exampleModalLabel">
                New Product
              </h1>
              <button
                type="button"
                class="btn-close bg-white"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body p-4">
                
              <form
                method="POST"
                action="add_product_logic.php"
                enctype="multipart/form-data"
              >
                <div class="mb-3">
                  <label for="productName" class="form-label"
                    >Product Name</label
                  >
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    id="productName"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="productDescription" class="form-label"
                    >Description</label
                  >
                  <textarea
                    name="description"
                    class="form-control"
                    id="productDescription"
                    rows="3"
                    required
                  ></textarea>
                </div>
                <div class="mb-3">
                  <label for="productPrice" class="form-label">Price</label>
                  <input
                    name="price"
                    type="number"
                    class="form-control"
                    id="productPrice"
                    step="0.01"
                    min="0"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="productCategory" class="form-label"
                    >Category</label
                  >
                  <select
                    name="category"
                    class="form-select"
                    id="productCategory"
                    required
                  >
                    <option value="" disabled selected>Select category</option>
                    <option value="E-books">E-books</option>
                    <option value="Templates">Templates</option>
                    <option value="For Kids">For Kids</option>
                    <option value="Courses">Courses</option>
                    <option value="Digital Art">Digital Art</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="productImage" class="form-label"
                    >Product Image</label
                  >
                  <input
                    name="image"
                    class="form-control"
                    type="file"
                    id="productImage"
                    required
                  />
                </div>

                <div class="modal-footer p-4">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button type="submit" class="btn btn-primary">
                    Save changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- bootstrap cdn -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script>
      $(document).ready(function () {
        const adminDashboard = $(".admin-dashboard-page");
        const sidebarToggleBtn = $(".sidebar-toggle");

        sidebarToggleBtn.on("click", function () {
          adminDashboard.toggleClass("expand-sidebar");
        });
      });
    </script>
  </body>
</html>
