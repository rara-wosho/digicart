<?php

include "includes/includes.php";


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="hasBG">
    <div
      class="signup-page d-flex align-items-center justify-content-center p-0 p-md-5"
    >
      <a
        style="
          width: 3rem;
          height: 3rem;
          position: absolute;
          top: 1rem;
          left: 1rem;
        "
        href="index.html"
        class="btn bg-white rounded-circle d-flex align-items-center justify-content-center"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="black"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-house-icon lucide-house"
        >
          <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
          <path
            d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
          />
        </svg>
      </a>
      <form action="signup-logic.php" method="POST" class="signup-form p-5 bg-white rounded-1 d-flex flex-column">
      <?php 
          if(isset($_SESSION['signup_error'])){
              echo '
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      ' . $_SESSION["signup_error"] . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              ';

              unset($_SESSION['signup_error']);
          }
      ?>
        <p class="text-muted">Hello Shopper!</p>
        <h3 class="mb-3">
          <span class="text-accent">Create</span> your Account
        </h3>

        <div style="gap: 18px" class="d-flex align-items-start my-4">
          <div class="personal-details">
            <h6 class="mb-3">Personal Details</h6>
            <div class="mb-3">
              <label for="firstname" class="form-label">First Name</label>
              <input
                required
                name="firstname"
                type="text"
                class="form-control"
                id="firstname"
                placeholder="Enter First Name"
              />
            </div>
            <div class="mb-3">
              <label for="lastname" class="form-label">Last Name</label>
              <input
                required
                name="lastname" 
                type="text"
                class="form-control"
                id="lastname"
                placeholder="Enter Last Name"
              />
            </div>
            <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-control" name="gender" id="">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
          </div>
          <div class="address-details">
            <h6 class="mb-3">Address</h6>

            <div class="mb-3">
              <label for="barangay" class="form-label">Barangay</label>
              <input
                required
                name="barangay"
                type="text"
                class="form-control"
                id="barangay"
                placeholder="Enter Barangay"
              />
            </div>
            <div class="mb-3">
              <label for="city" class="form-label">Municipality/City</label>
              <input
                required
                name="municipality"
                type="text"
                class="form-control"
                id="city"
                placeholder="Enter Municipality/City"
              />
            </div>
            <div class="mb-3">
              <label for="province" class="form-label">Province</label>
              <input
                required
                name="province"
                type="text"
                class="form-control"
                id="province"
                placeholder="Enter Province"
              />
            </div>
          </div>
          <div class="credential-details">
            <h6 class="mb-3">Credentials</h6>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                required
                name="email"
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter your email"
              />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input
                  required
                  name="password"
                  type="password"
                  class="form-control"
                  id="password"
                  placeholder="Enter password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Repeat Password</label>
              <div class="input-group">
                <input
                  required
                  name="repeat-password"
                  type="password"
                  class="form-control"
                  id="repeat-password"
                  placeholder="Confirm your password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="btns d-flex justify-content-between">
          <a href="signin.php" class="btn btn-outline-secondary px-5"
            >Back to sign in page</a
          >
          <button type="submit" name="signup-btn" class="btn btn-primary px-5">Sign Up</a>
        </div>
      </form>
    </div>

    <!-- JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- bootstrap cdn -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- Add this script for password validation -->
    <script>
      $(document).ready(function() {
        $("form").submit(function(event) {
          const password = $("#password").val();
          const repeatPassword = $("#repeat-password").val();
          
          if (password !== repeatPassword) {
            // Prevent form submission
            event.preventDefault();
            
            // Create an alert message
            const alertHtml = `
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Passwords do not match. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            `;
            
            // Insert the alert at the top of the form
            // First, remove any existing password mismatch alerts
            $(".alert").remove();
            $(this).prepend(alertHtml);
            
            // Optionally: highlight the password fields
            // $("#password, #repeat-password").addClass("is-invalid");
          }
        });
        
        // Remove the invalid class when user types in either password field
        // $("#password, #repeat-password").on("input", function() {
        //   $("#password, #repeat-password").removeClass("is-invalid");
        // });


          $("#togglePassword1").click(function() {
            // Toggle the type attribute
            const passwordInput = $("#password");
            const type = passwordInput.attr("type") === "password" ? "text" : "password";
            passwordInput.attr("type", type);
          });
          $("#togglePassword2").click(function() {
            // Toggle the type attribute
            const passwordInput = $("#repeat-password");
            const type = passwordInput.attr("type") === "password" ? "text" : "password";
            passwordInput.attr("type", type);
          });
      });


    </script>
  </body>
</html>
