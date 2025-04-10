<?php
    include "includes/includes.php";

    if(isset($_POST['signup-btn'])){
        //method to handle first form
        $user->createNewUser($connection, $_POST);
    }else{
        header('location: signup.php');
        die();
    }