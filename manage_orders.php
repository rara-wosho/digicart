<?php

    include "includes/includes.php";

    // redirect the user if not signed in or not an admin
    if(!isset($_SESSION['current_user']) || $_SESSION['current_user']['role'] !== "admin"){
        header('location: signin.php');
        exit();
    }else{
        $transactions = $transaction->displayOrders($connection);
        $keyword = null;
    
        if(isset($_GET['search-transaction'])){
        $keyword = $_GET['search-transaction'];
        $transactions = $transaction->searchTransaction($connection, $keyword) ;
        }
    }
  // get all products

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Orders</title>
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
            <li>
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
            <li class="active">
                <a  class="">
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
            <li>
                <a href="manage_transactions.php">
                <div
                    class="sidebar-icon d-flex align-items-center justify-content-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right-icon lucide-arrow-left-right"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>
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

        <!-- header  -->
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
            <h4 class="mb-0">Orders</h4>
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

        <!-- MAIN CONTENT  -->
        <div class="m-3 bg-white p-4 rounded shadow-sm">
            <!-- content header  -->
            <div class="main-content-header d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0 text-muted text-nowrap text-primary">Purchases: <?=$transactions->num_rows?></h5>
            <!-- <form method="GET" class="input-group w-50">
                <input value="<?=$keyword ?>" name="search-transaction" type="text" placeholder="Search..." class="form-control">
                <button type="submit" class="input-group-text bg-primary text-white">Search</button>
                <a href="manage_transactions.php" type="submit" name="reset-btn" class="input-group-text bg-danger text-white">Reset</a>
            </form> -->
            </div>

            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while($row = $transactions->fetch_assoc()){
                ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td><?=$row['fullname']?></td>
                        <td><?=$row['product_name']?></td>
                        <td><?=$row['price']?></td>
                        <td><?=$row['price']?></td>
                        <td><?=$row['transaction_date']?></td>
                        <td>
                        <div style="gap:8px" class="d-flex align-items-center">
                            <a href="update-order-status-logic.php?status=cancelled&order_id=<?=$row['transaction_id']?>" class="btn btn-sm <?=$row['status'] == "cancelled" ? "btn-danger" : "btn-outline-danger"?>">Cancel</a>
                            <a href="update-order-status-logic.php?status=pending&order_id=<?=$row['transaction_id']?>" class="btn btn-sm <?=$row['status'] == "pending" ? "btn-warning" : "btn-outline-warning"?>">Pending</a>
                            <a href="update-order-status-logic.php?status=shipped&order_id=<?=$row['transaction_id']?>" class="btn btn-sm <?=$row['status'] == "shipped" ? "btn-warning" : "btn-outline-warning"?>">Shipped</a>
                            <a href="update-order-status-logic.php?status=out_for_delivery&order_id=<?=$row['transaction_id']?>" class="btn btn-sm <?=$row['status'] == "out_for_delivery" ? "btn-success" : "btn-outline-success"?>">Out for Delivery</a>
                        </div>
                        </td>
                    </tr>
                <?php
                    }
                ?>
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
