<?php
        include "includes/includes.php";

        // redirect the user if  not an admin
        if($_SESSION['current_user']['role'] !== "admin"){
            header('location: signin.php');
            exit();
        }

        if(isset($_SESSION['current_user'])){
            if(isset($_GET['product_id'])){
                $productData = $digiProduct->getProductById($connection, $_GET['product_id']);
            }else{
                header("location: manage_products.php");
                exit();
            }
        }else{
            header("location: signin.php");
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $digiProduct->updateProduct($connection, $_GET['product_id'], $_POST, $_FILES);
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard</title>
        <link rel="icon" href="images/logo.png" type="image/x-icon" />
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
        />

        <link rel="stylesheet" href="style.css" />

        <!-- JQUERY CDN -->
        <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"
        ></script>
    </head>
    <body>

        <!-- header  sectionn  -->
        <div class="w-100 bg-white border-bottom header-section mb-3">
            <div class="header py-3 container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img
                        src="images/logo.png"
                        class="me-2"
                        width="50"
                        height="50"
                        alt=""
                    />
                    <p class="mb-0 fw-bold fs-5">
                        Digi<span class="text-primary">Cart</span>
                    </p>                  
                </div>
                <a href="profile.php" class="d-flex align-items-center">
                    <img
                        width="30"
                        height="30"
                        src="images/icons/user.png"
                        alt=""
                        class="rounded-circle"
                    />
                    <p class="mb-0 ms-2 fw-semibold"><?=$_SESSION['current_user']['firstname']?></p>
                </a>
            </div>
        </div>

        <div style="max-width:1000px;" class="mx-auto">
        <!-- FEEDBACK FOR UPDATING PRODUCT  -->
        <?php 
            if(isset($_SESSION['update_product_error'])){
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ' . $_SESSION["update_product_error"] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';

                unset($_SESSION['update_product_error']);
            }
        ?>
        </div>

        <!-- form section  -->
        <div style="max-width:1000px; gap:22px;" class="p-4 align-items-start rounded-2 mx-auto bg-white shadow-sm d-flex mt-3">
            <div class="w-50">
                <a href="manage_products.php" class="btn btn-outline-secondary px-4 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    Back
                </a>
                <div style="height:100%; background:var(--bg-body);" class="img-container rounded-2">
                    <img class="rounded-2 me-3 w-100" style="object-fit:contain; aspect-ratio:5/5;" src="<?=$productData['image_path']?>" alt="">
                </div>
            </div>
            <form
            method="POST"
            enctype="multipart/form-data"
            class="w-50"
            >
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <p class="mb-0 text-muted fw-bold fs-5">Edit Product</p>
                    <button class="btn btn-primary text-white">Update Changes</button>
                </div>
                <div class="mb-3">
                    <label for="productName" class="form-label"
                    >Product Name</label
                    >
                    <input
                    value="<?=$productData['name'] ?? ""?>"
                    name="name"
                    type="text"
                    class="form-control"
                    id="productName"
                    required
                    />
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label"
                    >Description</label
                    >
                    <textarea
                        name="description"
                        class="form-control"
                        id="productDescription"
                        rows="4"
                        required
                    ><?=$productData['description']?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price</label>
                    <input
                    value="<?=$productData['price'] ?? ""?>"
                    name="price"
                    type="number"
                    class="form-control"
                    id="productPrice"
                    step="0.01"
                    min="0"
                    required
                    />
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Stock</label>
                    <input
                    value="<?=$productData['stock'] ?? ""?>"
                    name="stock"
                    type="number"
                    class="form-control"
                    id="stock"
                    step="0.01"
                    min="0"
                    required
                    />
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label"
                    >Category</label
                    >
                    <select
                    value="<?=$productData['category'] ?? ""?>"
                    name="category"
                    class="form-select"
                    id="productCategory"
                    required
                    >
                        <option value="" disabled selected>Select category</option>
                        <option value="smartphone" <?=$productData['category'] == "smartphone" ? "selected": ""?>>Smartphone</option>
                        <option value="tablet" <?=$productData['category'] == "tablet" ? "selected": ""?>>Tablet</option>
                        <option value="laptop" <?=$productData['category'] == "laptop" ? "selected": ""?>>Laptop</option>
                        <option value="smart watch" <?=$productData['category'] == "smart watch" ? "selected": ""?>>Smart Watch</option>
                        <option value="speaker" <?=$productData['category'] == "speaker" ? "selected": ""?>>Speaker</option>
                    </select>
                </div>
                <div>
                    <label for="productImage" class="form-label"
                    >Product Image</label
                    >
                    <input
                    name="image"
                    class="form-control"
                    type="file"
                    id="productImage"
                    />
                </div>
            </form>
        </div>
        
    </body>
    <!-- bootstrap cdn -->
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
    ></script>
</html>
