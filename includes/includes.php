<?php

    session_start(); 

    require "database/Database.php";
    $connect = new Database();
    $connection = $connect->getConnection();

    include "classes/Users.php";
    $user = new Users();

    include "classes/DigitalProducts.php";
    $digiProduct = new DigitalProducts();

    include "classes/Cart.php";
    $cart = new Cart();
    
    include "classes/Transactions.php";
    $transaction = new Transactions();



    // include "classes/Orders.php";
    // $order = new Order();
