<?php
include "includes/includes.php";

// Check if form was submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Call updateUser method
    $digiProduct->addProduct($connection, $_POST, $_FILES);   
    // var_dump($_POST);
    // var_dump($_FILES);
} else {
    // Not a POST request, redirect back
    header("location: admin_dashboard.html");
    exit();
}
?>