<?php

    class Transactions{
    
        public function addTransaction($conn, $postData) {

            // sanitize data 
            $userId = $postData['transac-user-id'];
            $productId = $postData['transac-product-id'];
            $productName = htmlspecialchars($postData['transac-product-name']);
            $price = (int)$postData['transac-price'];
            $totalAmount = (int)$postData['transac-total'];
            $quantitySold = (int)$postData['cart_quantity'];
            $totalAmount = (int)$postData['transac-total'];
            $fullName = htmlspecialchars($postData['fullname']);
            $address = htmlspecialchars($postData['address']);
            $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
            $paymentMethod = htmlspecialchars($postData['payment-option']);
        
            $query = "INSERT INTO 
            transactions( `user_id`, `product_id`, `product_name`, `price`, `total`, `quantity`, `status`, `fullname`, `fulladdress`, `email`, `payment_option`) 
            VALUES ('$userId','$productId','$productName','$price','$totalAmount', '$quantitySold', 'pending', '$fullName','$address','$email','$paymentMethod')";
        
            $result = $conn->query($query);

            if($result){

                // Update product sales
                $this->updateProductSales($conn, $productId, $quantitySold);

                $this->updateStock($conn, $productId, $quantitySold);

                // remove the item from cart 
                $this->removeFromCart($conn, $userId, $productId);

                return true;
            }else{
                return false;
            }
        }

        public function displayOrders($conn){
            $q = "SELECT * 
                FROM transactions
                WHERE status = 'pending' OR status = 'shipped' OR status = 'out_for_delivery'
                ORDER BY transaction_date DESC";
            
            return $result = $conn->query($q);
        }

        public function displayOrdersPerUser($conn, $userId){
            $q = "SELECT * FROM transactions WHERE user_id='$userId' ORDER BY transaction_date DESC";

            return $result = $conn->query($q);
        }

        public function displayAllTransactions($conn, $status = 'all'){
            $q = "SELECT * 
                FROM transactions
                ORDER BY transaction_date DESC";
            
            return $result = $conn->query($q);
        }

        public function displayTransactionPerUser($conn, $userId){
            $q = "
                SELECT * 
                FROM transactions
                WHERE user_id = $userId
                ORDER BY transaction_date DESC
            ";
            
            $result = $conn->query($q);
            
            return $result;
        }

        private function getTransactionItems($conn, $transactionId){
            $stmt = $conn->prepare("
                SELECT ti.*, p.name, p.image_path
                FROM transaction_items ti
                JOIN products p ON ti.product_id = p.id
                WHERE ti.transaction_id = ?
            ");
            $stmt->bind_param("i", $transactionId);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $items = [];
            
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            
            return $items;
        }

        public function searchTransaction($conn, $keyword){
            $search_term = "%" . $keyword . "%";
            
            $query = "SELECT * FROM transactions WHERE product_name LIKE ? OR fullname LIKE ? OR fulladdress LIKE ? OR email LIKE ? ORDER BY transaction_date DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $search_term, $search_term, $search_term, $search_term);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;
        }

        // if transaction is complete, add to product sales 
        private function updateProductSales($conn, $productId, $quantitySold){
            $stmt = $conn->prepare("
                UPDATE products 
                SET sold = sold + ? 
                WHERE product_id = ?");
            $stmt->bind_param("ii", $quantitySold, $productId);
            return $stmt->execute();
        }

        public function updateOrderStatus($conn, $status, $orderId){
            $q = "UPDATE transactions SET status='$status' WHERE transaction_id = $orderId";

            return $result = $conn->query($q);
        }

        public function updateStock($conn, $productId, $quantitySold){
            $stmt = $conn->prepare("
            UPDATE products 
            SET stock = stock - ? 
            WHERE product_id = ?");

            $stmt->bind_param("ii", $quantitySold, $productId);
            return $stmt->execute();
        }

        // if transaction is complete, remove the item from cart 
        private function removeFromCart($conn, $userId, $productId){
            $q= "DELETE FROM cart WHERE product_id=$productId AND user_id=$userId";

            return $results = $conn->query($q);
        }
    }