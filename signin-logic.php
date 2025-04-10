<?php

    include "includes/includes.php";

    if(isset($_POST['signin-btn'])){

        $user->verifyUser($connection, $_POST);

    }else{
        header('location: signin.php');
        die();
    }