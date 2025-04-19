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
                        onclick="window.location.href='index.php'"
                        style="width: 40px; height: 40px; background-color: var(--bg-body)"
                        class="btn rounded-circle border d-flex align-items-center justify-content-center p-0 me-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    </button>
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
    </body>

    <!-- bootstrap cdn -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
</html>
