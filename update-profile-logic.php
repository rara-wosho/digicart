<?php
include "includes/includes.php";

if(!isset($_SESSION['current_user'])){
    header("location: signin.php");
    exit();
}

// Check if form was submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user ID from URL parameter or POST data
    $userId = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];

    // Call updateUser method
    $user->updateUser($connection, $_POST, $userId);
} else {
    // Not a POST request, redirect back
    header("location: profile.php");
    exit();
}
?>