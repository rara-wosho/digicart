<?php

    class Users{
        //Users info
        private $firstname;
        private $lastname;
        private $gender;
        private $barangay;
        private $municipality;
        private $province;

        //Users credentials
        private $email;
        private $password;
        private $repeatPassword;
        private $userID;
        
        private $conn;


        //==================================
        public function createNewUser($conn, $postData){
            $this->email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
            $this->password = filter_var($postData['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->repeatPassword = filter_var($postData['repeat-password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $this->firstname = filter_var($postData['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->lastname = filter_var($postData['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->gender = filter_var($postData['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->barangay = filter_var($postData['barangay'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->municipality = filter_var($postData['municipality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->province = filter_var($postData['province'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    

            if ($this->password !== $this->repeatPassword) {
                $_SESSION['signup_error'] = "Passwords do not match";
            } else {
                $user_check_query = "SELECT * FROM users WHERE email='$this->email'";
                $user_check_result = $conn->query($user_check_query);
    
                if ($user_check_result->num_rows > 0) {
                    $_SESSION['signup_error'] = "Email is already taken";
                }
            }
    
            if (isset($_SESSION['signup_error'])) {
                // If there's a problem, redirect with the data
                $_SESSION['signup_data'] = $postData;
                header('location: signup.php');
                die();

            } else {

                // password  verify is  not working so store plain password 
                // $hashedPass = password_hash($this->password, PASSWORD_DEFAULT); 

                // Insert into the database
                $insertQueryInfo = "INSERT INTO users(firstname, lastname, role, gender, barangay, municipality, province,email,password) 
                                        VALUES('$this->firstname', '$this->lastname', 'user', '$this->gender', '$this->barangay', '$this->municipality', '$this->province','$this->email','$this->password')";
                $insertInfoResult = $conn->query($insertQueryInfo);


            
                if ($insertInfoResult) {

                    // $displayPicSql = "INSERT INTO user_pfp (user_id, pfp_path) VALUES($lastinsertedID, 'pfp_images/default_image.jpg')";

                    // $conn->query($displayPicSql);

                    $_SESSION['signup_success'] = "Registration Successful, Please Sign In";
                    header('location: signin.php');
                    die();
                } else {
                    $_SESSION['signup_error'] = "Error: Something went wrong while we register your informations.";
                }
                
                header('location: signup.php');
                die();
            }
        }

       
        public function verifyUser($conn, $postData) {
            $this->email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
            $this->password = $postData['password'];
        
            // Prepare statement to prevent SQL injection
            $user_check_query = "SELECT * FROM users WHERE email=?";
            $stmt = $conn->prepare($user_check_query);
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $user_record = $result->fetch_assoc();
                $db_password = $user_record['password'];
                $id = $user_record['user_id'];
                $role = $user_record['role'];
                
                // Using plain text password comparison (should use password_verify in production)
                if ($this->password == $db_password) {
                // password verify is not working: if(password_verify($this->password, $db_password)) {
                    
                    // Set session variables for current user
                    $_SESSION['current_user'] = $user_record;
                    
                    // Redirect to dashboard for admins
                    if ($role == 'admin') {
                        $_SESSION['user_admin'] = true;
                        header('location: admin_dashboard.php');
                        exit();
                    }
                    
                    header('location: products.php');
                    exit();
                } else {
                    $_SESSION['signin_error'] = "Password doesn't match with our records";
                }
            } else {
                $_SESSION['signin_error'] = "User not found";
            }
            
            // Handle error and redirect
            if (isset($_SESSION['signin_error'])) {
                $_SESSION['signin_data'] = $postData;
                header('location: signin.php');
                exit();
            }
        }


        public function updateUser($conn, $postData, $userId) {
            // Sanitize input data
            $firstname = filter_var($postData['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_var($postData['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_var($postData['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $barangay = filter_var($postData['barangay'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $municipality = filter_var($postData['municipality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $province = filter_var($postData['province'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Prepare statement to prevent SQL injection
            $update_query = "UPDATE users SET 
                            firstname = ?, 
                            lastname = ?, 
                            gender = ?, 
                            barangay = ?, 
                            municipality = ?, 
                            province = ? 
                            WHERE user_id = ?";
                            
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssssssi", $firstname, $lastname, $gender, $barangay, $municipality, $province, $userId);
            
            // Execute the update
            if($stmt->execute()) {
                // Update was successful
                
                // Update the session with new user information
                $user_query = "SELECT * FROM users WHERE user_id = ?";
                $user_stmt = $conn->prepare($user_query);
                $user_stmt->bind_param("i", $userId);
                $user_stmt->execute();
                $result = $user_stmt->get_result();
                
                if($result->num_rows > 0) {
                    $user_record = $result->fetch_assoc();
                    $_SESSION['current_user'] = $user_record;
                    
                    $_SESSION['update_success'] = "Profile information updated successfully!";
                    header('location: profile.php');
                    exit();
                }
            } else {
                // Update failed
                $_SESSION['update_error'] = "Failed to update profile information. Please try again.";
                header('location: profile.php');
                exit();
            }
        }

        public function displayUser($conn, $userID){
            $sql = "SELECT * FROM user WHERE user_id=?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            
            $result = $stmt->get_result();

            if (!$result) {
                die("Query Failed: " . $conn->error);
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        public function uploadPfp($conn, $userID){

        }

        public function displayUsers($conn){
            $sql = "SELECT * FROM users";

            $result = $conn->query($sql);
            return $result;
        }

        public function searchUser($conn, $searchTerm) {
            $searchTerm = $conn->real_escape_string($searchTerm);
        
            $sql = "SELECT * FROM users WHERE users.email LIKE '%$searchTerm%'
                       OR users.firstname LIKE '%$searchTerm%'
                       OR users.barangay LIKE '%$searchTerm%'
                       OR users.province LIKE '%$searchTerm%'
                       OR users.city LIKE '%$searchTerm%'
                       OR users.lastname LIKE '%$searchTerm%'";
        
            $result = $conn->query($sql);
        
            return $result;
        }
        

    }