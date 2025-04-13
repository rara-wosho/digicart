<?php

class Transactions{
 
    public function addTransaction($conn, $postData) {

        // sanitize data 
        $userId = $postData['transac-user-id'];
        $productId = $postData['transac-product-id'];
        $productName = htmlspecialchars($postData['transac-product-name']);
        $price = (int)$postData['transac-price'];
        $totalAmount = (int)$postData['transac-total'];
        $fullName = htmlspecialchars($postData['fullname']);
        $address = htmlspecialchars($postData['address']);
        $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
        $paymentMethod = htmlspecialchars($postData['payment-option']);
    
        $query = "INSERT INTO 
        transactions( `user_id`, `product_id`, `product_name`, `price`, `total`, `fullname`, `fulladdress`, `email`, `payment_option`) 
        VALUES ('$userId','$productId','$productName','$price','$totalAmount','$fullName','$address','$email','$paymentMethod')";
    
        $result = $conn->query($query);

        if($result){

            // Update product stock
            $this->updateProductSales($conn, $productId, 1);

            // remove the item from cart 
            $this->removeFromCart($conn, $userId, $productId);

            return true;
        }else{
            return false;
        }
    }

    public function displayAllTransactions($conn){
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

    private function updateProductSales($conn, $productId, $quantitySold){
        $stmt = $conn->prepare("
            UPDATE products 
            SET sold = sold + ? 
            WHERE product_id = ?");
        $stmt->bind_param("ii", $quantitySold, $productId);
        return $stmt->execute();
    }

    private function removeFromCart($conn, $userId, $productId){
        $q= "DELETE FROM cart WHERE product_id=$productId AND user_id=$userId";

        return $results = $conn->query($q);
    }
}