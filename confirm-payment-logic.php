<?php

    include "includes/includes.php";

    if(isset($_POST)){
        $result = $transaction->addTransaction($connection, $_POST);

        if($result){
            header("location: orders.php");
            exit();
        }else{
            $_SESSION['transaction_error'] = "Failed to purchase the product.";
        }

        $product_Id = $_POST['transac-product-id'];
        header("location: check-out.php?product_id=$product_Id");
        exit();
    }


    // var_dump($_POST);