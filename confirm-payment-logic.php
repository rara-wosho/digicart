<?php

    include "includes/includes.php";

    if(isset($_POST)){
        $result = $transaction->addTransaction($connection, $_POST);

        if($result){
            $_SESSION['transaction_success'] = "Successfully purchased this product.";
        }else{
            $_SESSION['transaction_error'] = "Failed to purchase the product.";
            
        }

        $product_Id = $_POST['transac-product-id'];
        header("location: check-out.php?product_id=$product_Id");
        exit();
    }


    // var_dump($_POST);