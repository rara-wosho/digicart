<?php

    include "includes/includes.php";

    if(isset($_GET['status']) && isset($_GET['order_id'])){
        $status = $_GET['status'];
        $orderId = $_GET['order_id'];

        if($transaction->updateOrderStatus($connection, $status, $orderId)){
            if(isset($_GET['user'])){
                header("location: orders.php");
                exit();
            }

            header("location: manage_orders.php");
            exit();
        }
    }else{
        header('location: manage_orders.php');
        exit();
    }