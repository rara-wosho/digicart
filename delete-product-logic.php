<?php

    include "includes/includes.php";

    if(isset($_GET['product_id'])){
        $productId = $_GET['product_id'];

        $digiProduct->deleteProduct($connection, $productId);
        
    }else{
        header("location: manage_products.php");
        exit();
    }