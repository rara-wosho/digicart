<?php

    include "includes/includes.php";

    if(isset($_GET['user_id']) && isset($_GET['product_id'])){
        $ownerID = $_GET['user_id'];
        $productID = $_GET['product_id'];
        $cart->removeFromCart($connection , $ownerID, $productID);

        header('location: cart.php');
        exit();
    }else{
        header('location: cart.php');
        exit();
    }