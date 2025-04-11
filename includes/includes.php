<?php

    session_start(); 

    require "database/Database.php";
    $connect = new Database();
    $connection = $connect->getConnection();

    include "classes/Users.php";
    $user = new Users();

    include "classes/DigitalProducts.php";
    $digiProduct = new DigitalProducts();

    // include "classes/Alerts.php";
    // $alert = new Alerts();


    // include "classes/Cart.php";
    // $cart = new Cart();

    // include "classes/Orders.php";
    // $order = new Order();
