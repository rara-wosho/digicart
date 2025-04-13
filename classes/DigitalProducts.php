<?php
    class DigitalProducts {
        private $name;
        private $description;
        private $price;
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
                                (name, description, price, category, image_path, file_path, sold, ratings, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("ssdsssii", 
                    $this->name, 
                    $this->description, 
                    $this->price, 
                    $this->category, 
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
            $category = filter_var($productData['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Get current product data
            $current_product = $this->getProductById($conn, $productId);
            if (!$current_product) {
                $_SESSION['product_error'] = "Product not found";
                return false;
            }
            
            $image_path = $current_product['image_path'];
            $file_path = $current_product['file_path'];
            
            // Handle image upload if provided
            if (isset($fileData['image']) && $fileData['image']['size'] > 0) {
                $image_name = time() . '_' . $fileData['image']['name'];
                $image_tmp = $fileData['image']['tmp_name'];
                $image_destination = 'uploads/images/' . $image_name;
                $allowed_image_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                $image_ext = strtolower(pathinfo($fileData['image']['name'], PATHINFO_EXTENSION));
                
                if (!in_array($image_ext, $allowed_image_ext)) {
                    $_SESSION['product_error'] = "Invalid image format. Allowed formats: " . implode(', ', $allowed_image_ext);
                    return false;
                }
                
                if (move_uploaded_file($image_tmp, $image_destination)) {
                    // Delete old image if it exists
                    if (file_exists($current_product['image_path'])) {
                        unlink($current_product['image_path']);
                    }
                    $image_path = $image_destination;
                } else {
                    $_SESSION['product_error'] = "Failed to upload image";
                    return false;
                }
            }
            
            // Handle digital file upload if provided
            if (isset($fileData['digital_file']) && $fileData['digital_file']['size'] > 0) {
                $file_name = time() . '_' . $fileData['digital_file']['name'];
                $file_tmp = $fileData['digital_file']['tmp_name'];
                $file_destination = 'uploads/products/' . $file_name;
                $allowed_file_ext = ['pdf', 'zip', 'mp3', 'mp4', 'epub', 'psd', 'ai'];
                
                $file_ext = strtolower(pathinfo($fileData['digital_file']['name'], PATHINFO_EXTENSION));
                
                if (!in_array($file_ext, $allowed_file_ext)) {
                    $_SESSION['product_error'] = "Invalid file format. Allowed formats: " . implode(', ', $allowed_file_ext);
                    return false;
                }
                
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    // Delete old file if it exists
                    if (file_exists($current_product['file_path'])) {
                        unlink($current_product['file_path']);
                    }
                    $file_path = $file_destination;
                } else {
                    $_SESSION['product_error'] = "Failed to upload digital file";
                    return false;
                }
            }
            
            // Update product in database
            $update_query = "UPDATE products SET name = ?, description = ?, price = ?, category = ?, 
                            image_path = ?, file_path = ?, updated_at = NOW() WHERE product_id = ?";
            
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssdsssi", $name, $description, $price, $category, $image_path, $file_path, $productId);
            
            if ($stmt->execute()) {
                return true;
            } else {
                $_SESSION['product_error'] = "Database error: " . $conn->error;
                return false;
            }
        }
        

        public function deleteProduct($conn, $productId) {
            // Get current product data
            $product = $this->getProductById($conn, $productId);
            if (!$product) {
                $_SESSION['product_error'] = "Product not found";
                return false;
            }
            
            // Delete the product files
            if (file_exists($product['image_path'])) {
                unlink($product['image_path']);
            }
            
            if (file_exists($product['file_path'])) {
                unlink($product['file_path']);
            }
            
            // Delete from database
            $delete_query = "DELETE FROM products WHERE product_id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("i", $productId);
            
            if ($stmt->execute()) {
                return true;
            } else {
                $_SESSION['product_error'] = "Database error: " . $conn->error;
                return false;
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
        
        public function getAllCategories($conn) {
            $query = "SELECT DISTINCT category FROM products ORDER BY category";
            $result = $conn->query($query);
            
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['category'];
            }
            
            return $categories;
        }
    }
?>