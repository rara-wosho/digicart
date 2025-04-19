<?php
    class DigitalProducts {
        private $name;
        private $description;
        private $price;
        private $stock;
        private $category;
        private $image_path;
        private $file_path;
        private $sold;
        private $ratings;

        // add product to database 
        public function addProduct($conn, $productData, $fileData) {
            // Sanitize input data
            $this->name = filter_var($productData['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->description = filter_var($productData['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->price = filter_var($productData['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $this->stock = $productData['stock'];
            $this->category = filter_var($productData['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Handle image upload
            $image_name = time() . '_' . $fileData['image']['name'];
            $image_tmp = $fileData['image']['tmp_name'];
            $image_destination = 'uploads/images/' . $image_name;
            $allowed_image_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            // Get image extension
            $image_ext = strtolower(pathinfo($fileData['image']['name'], PATHINFO_EXTENSION));
            
            // Validate image type/extension
            if (!in_array($image_ext, $allowed_image_ext)) {
                $_SESSION['add_product_error'] = "Invalid image format. Allowed formats: " . implode(', ', $allowed_image_ext);
                header("location: manage_products.php");
                exit();
            }
            
            // Move uploaded image
            if (move_uploaded_file($image_tmp, $image_destination)) {
                $this->image_path = $image_destination;
                
                // For testing: this is a static Google Drive link instead of uploading the file
                $this->file_path = "https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx";
                
                // Initialize sold count and ratings
                $sold = 0;
                $ratings = 0;
                
                // Prepare insert statement with new fields
                $insert_query = "INSERT INTO products 
                                (name, description, price, category, stock, image_path, file_path, sold, ratings, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("ssdsissii", 
                    $this->name, 
                    $this->description, 
                    $this->price, 
                    $this->category, 
                    $this->stock, 
                    $this->image_path, 
                    $this->file_path,
                    $sold,
                    $ratings
                );
                
                if ($stmt->execute()) {
                    $_SESSION['add_product_success'] = "Product Added Successfully.";
                    header("location: manage_products.php");
                    exit();
                } else {
                    $_SESSION['add_product_error'] = "Cannot add product: " . $conn->error;
                    header("location: manage_products.php");
                    exit();
                }
            } else {
                $_SESSION['add_product_error'] = "Failed to upload image";
                header("location: manage_products.php");
                exit();
            }
        }
        
        // Get all products from db 
        public function getAllProducts($conn, $category = null, $sortingField = "created_at", $sortingMethod = "DESC") {

            $query = "SELECT * FROM products ORDER BY $sortingField $sortingMethod";

            if($category != null && $category != "all"){
                $query = "SELECT * FROM products WHERE category='$category' ORDER BY $sortingField $sortingMethod";
            }
            
            $stmt = $conn->prepare($query);
            
            $stmt->execute();
            $results = $stmt->get_result();
            
            return $results;
        }
        

        public function getProductsByCategory($conn, $category, $limit = null, $offset = 0) {
            $query = "SELECT * FROM products WHERE category = ? ORDER BY created_at DESC";
            
            if ($limit !== null) {
                $query .= " LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sii", $category, $limit, $offset);
            } else {
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            
            return $products;
        }
        
        // get a specific product 
        public function getProductById($conn, $productId) {
            $query = "SELECT * FROM products WHERE product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $results = $stmt->get_result();
            
            return $results->fetch_assoc();
        }

        // update or edit product details 
        public function updateProduct($conn, $productId, $productData, $fileData = null) {
            // Sanitize input data
            $name = filter_var($productData['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_var($productData['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price = filter_var($productData['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $stock = $productData['stock'];
            $category = filter_var($productData['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $productId = (int)$productId;
        
            // Initialize variables
            $image_path = null;
            $update_image = false;
        
            // Handle image upload if new image is provided
            if ($fileData && isset($fileData['image']) && $fileData['image']['error'] == UPLOAD_ERR_OK) {
                $allowed_image_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $image_ext = strtolower(pathinfo($fileData['image']['name'], PATHINFO_EXTENSION));
                
                // Validate image type
                if (!in_array($image_ext, $allowed_image_ext)) {
                    $_SESSION['update_product_error'] = "Invalid image format. Allowed formats: " . implode(', ', $allowed_image_ext);
                    header("location: manage_products.php");
                    exit();
                }
                
                // Generate new image name and path
                $image_name = time() . '_' . $fileData['image']['name'];
                $image_tmp = $fileData['image']['tmp_name'];
                $image_destination = 'uploads/images/' . $image_name;
                
                if (move_uploaded_file($image_tmp, $image_destination)) {
                    $image_path = $image_destination;
                    $update_image = true;
                } else {
                    $_SESSION['update_product_error'] = "Failed to upload new image";
                    header("location: manage_products.php");
                    exit();
                }
            }
        
            try {
                // Build the update query dynamically based on provided data
                $query = "UPDATE products SET name = ?, description = ?, price = ?, category = ?, stock = ?";
                $params = [$name, $description, $price, $category, $stock];
                $types = "ssdsi";
        
                // Add image to update if new image was uploaded
                if ($update_image) {
                    $query .= ", image_path = ?";
                    $params[] = $image_path;
                    $types .= "s";
                }
        
                $query .= " WHERE product_id = ?";
                $params[] = $productId;
                $types .= "i";
        
                // Prepare and execute the statement
                $stmt = $conn->prepare($query);
                $stmt->bind_param($types, ...$params);
                
                if ($stmt->execute()) {
                    // Only update session if rows were affected
                    if ($stmt->affected_rows > 0) {
                        $_SESSION['update_product_success'] = "Product updated successfully.";
                    } else {
                        $_SESSION['update_product_notice'] = "No changes were made to the product.";
                    }
                } else {
                    $_SESSION['update_product_error'] = "Update failed: " . $stmt->error;
                }
                
            } catch (Exception $e) {
                $_SESSION['update_product_error'] = "Error updating product: " . $e->getMessage();
            }

            if(isset($_SESSION['update_product_error']) || isset($_SESSION['update_product_notice']) ){
                header("location: edit_product_form.php?product_id=$productId");
                exit();
            }

            if(isset($_SESSION['update_product_success']) ){
                header("location: manage_products.php");
                exit();
            }
        }   
        

        public function deleteProduct($conn, $productId) {
        
            try {
                // Begin transaction to ensure data consistency
                $conn->begin_transaction();
        
                // First delete the associated image file if it exists
                $stmt = $conn->prepare("SELECT image_path FROM products WHERE product_id = ?");
                $stmt->bind_param("i", $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $product = $result->fetch_assoc();
                    if (!empty($product['image_path']) && file_exists($product['image_path'])) {
                        unlink($product['image_path']);
                    }
                }
        
                // 2. Then delete the product record
                $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
                $stmt->bind_param("i", $productId);
                $stmt->execute();
        
                // Check if any row was actually deleted
                if ($stmt->affected_rows > 0) {
                    $conn->commit();
                    $_SESSION['delete_product_success'] = "Product deleted successfully.";
                } else {
                    $conn->rollback();
                    $_SESSION['delete_product_error'] = "No product found with that ID.";
                }
        
                header("location: manage_products.php");
                exit();
        
            } catch (Exception $e) {
                $conn->rollback();
                $_SESSION['delete_product_error'] = "Error deleting product: " . $e->getMessage();
                header("location: manage_products.php");
                exit();
            }
        }

        public function searchProducts($conn, $keyword) {
            $search_term = "%" . $keyword . "%";
            
            $query = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $search_term, $search_term);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }
        
        public function topProducts($conn, $limit = 5){
            $q = "SELECT * FROM products WHERE sold > 0 ORDER BY sold DESC LIMIT $limit";

            return $result = $conn->query($q);
        }
        
        public function newProducts($conn,  $limit = 5){
            $q = "SELECT * FROM products ORDER BY created_at DESC LIMIT $limit";

            return $result = $conn->query($q);
        }
    }
?>