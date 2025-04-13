<?php
  include "includes/includes.php";

  if(!isset($_SESSION['current_user']) || $_SESSION['current_user']['role'] !== "admin"){
    header('location: signin.php');
    exit();
  }

  $users = $user->displayAllUsers($connection);
  $transactions = $transaction->displayAllTransactions($connection);
  $products = $digiProduct->getAllProducts($connection);
  $topProducts = $digiProduct->topProducts($connection);

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
        class="sidebar bg-white shadow-sm px-2 d-flex flex-column pb-3"
      >
        <div class="sidebar-header mb-4 py-3 d-flex align-items-center">
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
          <li class="active">
            <a class="">
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
            <a href="manage_transactions.php" class="">
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
              <p class="sidebar-label mb-0 px-2">Transactions</p>
            </a>
          </li>
          <li class="">
            <a href="manage_users.php" class="">
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
          <li class="">
            <a href="manage_products.php" class="">
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

        <a style="background-color:rgb(240,240,245)" href="logout-logic.php" class="rounded-3 d-flex  align-items-center text-black py-2 px-3"
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
        class="dashboard-header shadow-sm bg-white py-3 d-flex align-items-center ps-2 pe-5"
      >
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
        <h4 class="mb-0">Dashboard</h4>

        <a href="profile.php" class="d-flex align-items-center ms-auto">
          <img
            width="30"
            height="30"
            src="images/icons/user.png"
            alt=""
            class="rounded-circle"
          />

          <p class="mb-0 ms-2 fw-semibold"><?=$_SESSION['current_user']['firstname']?></p>
        </a>
      </div>

      <!-- overview  -->
      <div class="row row-cols-4 mt-3 mx-1">
        <div class="col mb-1">
          <a href="manage_users.php" class="bg-white rounded-2 shadow-sm p-4 d-flex align-items-center">
            <div style="background:rgb(189, 243, 200);" class="p-3 rounded-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round-icon lucide-circle-user-round"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg>
            </div>
            <div class="ms-2">
              <h3 class="mb-0 d-inline-block text-black"><?=$users->num_rows?></h3>
              <p class="mb-0 text-muted">DigiCart Users</p>
            </div>
          </a>
        </div>
        <div class="col mb-1">
          <a href="manage_transactions.php" class="bg-white rounded-2 shadow-sm p-4 d-flex align-items-center">
            <div style="background:rgb(234, 189, 243);" class="p-3 rounded-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
            </div>
            <div class="ms-2">
              <h3 class="mb-0 d-inline-block text-black"><?=$transactions->num_rows?></h3>
              <p class="mb-0 text-muted">Total Transactions</p>
            </div>
          </a>
        </div>
        <div class="col mb-1">
          <a href="manage_products.php" class="bg-white rounded-2 shadow-sm p-4 d-flex align-items-center">
            <div style="background:rgb(243, 189, 189);" class="p-3 rounded-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-icon lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><polyline points="3.29 7 12 12 20.71 7"/><path d="m7.5 4.27 9 5.15"/></svg>
            </div>
            <div class="ms-2">
              <h3 class="mb-0 d-inline-block text-black"><?=$products->num_rows?></h3>
              <p class="mb-0 text-muted">Total Products</p>
            </div>
          </a>
        </div>
        <div class="col mb-1">
          <div class="bg-white rounded-2 shadow-sm p-4 d-flex align-items-center">
            <div style="background:rgb(189, 223, 243);" class="p-3 rounded-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column-stacked-icon lucide-chart-column-stacked"><path d="M11 13H7"/><path d="M19 9h-4"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="15" y="5" width="4" height="12" rx="1"/><rect x="7" y="8" width="4" height="9" rx="1"/></svg>
            </div>
            <div class="ms-2">
              <h3 class="mb-0 d-inline-block text-black">5</h3>
              <p class="mb-0 text-muted">Categories</p>
            </div>
          </div>
        </div>
      </div>

      <div class="best seller bg-white m-3 rounded-2 shadow-sm p-4 mb-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h4 class="text-muted mb-0">Best Selling Products</h4>
          <a href="manage_products.php?category=all&sorting-field=sold&sorting-method=DESC" class="btn btn-primary text-white">View All</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Ratings</th>
                    <th scope="col">Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while($row = $topProducts->fetch_assoc()){
                ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td>
                          <img src="<?=$row['image_path']?>" width="30" height="30" class="rounded-2" alt="">  
                        </td>
                        <td><?=$row['name']?></td>
                        <td>₱<?=$row['price']?></td>
                        <td><?=$row['category']?></td>
                        <td><?=$row['ratings']?></td>
                        <td class="text-primary fw-semibold"><?=$row['sold']?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
      </div>

      <div class="best seller bg-white m-3 rounded-2 shadow-sm p-4">
        <h4 class="text-muted mb-3">Top Performing Employees</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Department</th>
                    <th scope="col">Address</th>
                    <th scope="col">Account Sales</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                  <td>1</td>
                  <td>Mherafe Cabug</td>
                  <td>Female</td>
                  <td>Sales and Marketing</td>
                  <td>Sibaroc, Jimenez, Misamis Occidental</td>
                  <td>95%</td>
              </tr>
            </tbody>
        </table>
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
