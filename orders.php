<?php

    include "includes/includes.php";

    if(!isset($_SESSION['current_user'])){
        header("location: signin.php");
        exit();
    }else{
        $orders = $transaction->displayOrdersPerUser($connection, $_SESSION['current_user']['user_id']);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Your Orders</title>
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
    <body class="hasBG">
        <div class="profile-page d-flex flex-column">
            <div class="profile-page-header bg-white">
                <div class="container d-flex py-3">
                <button
                    onclick="window.history.back()"
                    style="width: 40px; height: 40px; background-color: var(--bg-body)"
                    class="btn rounded-circle border d-flex align-items-center justify-content-center p-0"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-chevron-left-icon lucide-chevron-left"
                    >
                    <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>

                <div class="ms-2 d-flex align-items-center">
                    <img
                    width="40"
                    height="40"
                    src="images/logo.png"
                    alt=""
                    class="ms-1"
                    />
                    <p class="mb-0 sidebar-label fw-bold fs-5">
                    Digi<span class="text-primary">Cart</span>
                    </p>
                </div>

                <a href="logout-logic.php" class="btn btn-danger ms-auto btn-sm px-4 m-0 d-flex align-items-center">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-log-out-icon lucide-log-out me-1"
                    >
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" x2="9" y1="12" y2="12" />
                    </svg>
                    Log Out
                </a>
                </div>
            </div>

            <!-- title  -->
            <div
                class="d-flex justify-content-center align-items-center py-5 flex-column"
            >
                <h1 class="fw-semibold">Your Orders</h1>
                <p class="mb-0 text-center text-muted">
                    <?=$orders->num_rows?> Total Orders
                </p>
            </div>

            <div
                style="min-height: 75vh"
                class="profile-content bg-white py-5 border-bottom"
            >
                <div class="container mx-auto">
                    <h4>Order History</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-secondary" scope="col">Name</th>
                            <th class="text-secondary" scope="col">Price</th>
                            <th class="text-secondary" scope="col">Quantity</th>
                            <th class="text-secondary" scope="col">Amount</th>
                            <th class="text-secondary" scope="col">Date</th>
                            <th class="text-secondary" scope="col">Status</th>
                            <th class="text-secondary" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $orders->fetch_assoc()): ?>
                            <tr>
                                <td><?=$row['product_name']?></td>
                                <td>₱<?=$row['price']?></td>
                                <td><?=$row['quantity']?></td>
                                <td>₱<?=$row['total']?></td>
                                <td><?=$row['transaction_date']?></td>
                                <td><?=$row['status'] == 'out_for_delivery' ? 'out for delivery' : $row['status']?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if($row['status'] == "pending"){ ?>
                                            <a href="update-order-status-logic.php?user=1&status=cancelled&order_id=<?=$row['transaction_id']?>" class="btn btn-outline-danger btn-sm">Cancel</a>
                                        <?php }?>
                                        <?php if($row['status'] == "out_for_delivery"){ ?>
                                            <a href="update-order-status-logic.php?user=1&status=received&order_id=<?=$row['transaction_id']?>" class="btn btn-outline-success btn-sm">Receive Order</a>
                                        <?php }?>
                                        <?php if($row['status'] == "received"){ ?>
                                            <button class="btn btn-sm btn-success" disabled>Received</button>
                                        <?php }?>
                                        <?php if($row['status'] == "cancelled"){ ?>
                                            <button class="btn btn-sm btn-danger" disabled>Cancelled</button>
                                        <?php }?>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                        </tbody>
                    </table> 
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
    </body>

    <!-- bootstrap cdn -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
</html>
