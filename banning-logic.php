<?php

    include "includes/includes.php";
    if(isset($_GET['isBan']) && isset($_GET['user_id'])){
        $userId = $_GET['user_id'];
        $status = $_GET['isBan'];
        $result = $user->toggleBan($connection, $userId, $status);

        if($result){
            header("location: manage_users.php");
            exit();
        }
    }else{
        header("location: manage_users.php");
        exit();
    }