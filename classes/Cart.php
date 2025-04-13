<?php

class Cart
{

    public function addToCart($conn, $ownerID, $productID){
        
        if(!$this->isInCart($conn, $ownerID, $productID)){
            $q = "INSERT INTO `cart`(`product_id`, `user_id`) VALUES ('$productID','$ownerID')";
            return $results = $conn->query($q);
        }
    }

    public function isInCart($conn, $ownerID, $productID){
        $q = "SELECT * FROM cart WHERE product_id=$productID AND user_id=$ownerID";

        $results = $conn->query($q);

        if($results->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    // get all items from user's cart
    public function getCartProducts($conn, $ownerID){
        $q= "SELECT p.*, c.* 
                FROM cart c
                JOIN products p ON c.product_id = p.product_id
                WHERE c.user_id = $ownerID ORDER BY added_at DESC";

        return $results = $conn->query($q);
    }
    
    // remove an item from cart 
    public function removeFromCart($conn , $ownerID, $productID){
        $q= "DELETE FROM cart WHERE product_id=$productID AND user_id=$ownerID";

        return $results = $conn->query($q);
    }

}