<?php

include "includes/includes.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign In</title>
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
      class="signin-page d-flex align-items-center justify-content-center p-0 p-md-5"
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
      <form style="max-width: 500px;" method="POST" action="signin-logic.php" class="p-5 bg-white rounded-1 d-flex flex-column w-100">

      <?php 
          if(isset($_SESSION['signin_error'])){
              echo '
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      ' . $_SESSION["signin_error"] . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              ';

              unset($_SESSION['signin_error']);
          }
      ?>

        <p class="text-muted">Welcome back!</p>
        <h3 class="mb-3">
          <span class="text-accent">Sign In</span> with your Account
        </h3>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label"
            >Email address</label
          >
          <input
            required
            name="email"
            type="email"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="name@example.com"
          />
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label"
            >Password</label
          >
          <input
            required
            name="password"
            type="password"
            class="form-control"
            id="exampleFormControlInput2"
            placeholder="Enter password"
          />
        </div>
        <div class="btns d-flex align-items-center flex-column">
          <input type="submit" name="signin-btn" class="btn btn-primary w-100 mb-2" value="Sign In"/>
          <p class="mb-0 fs-6 text-secondary mb-2 mt-3">
            Don't have an account?
          </p>
          <a href="signup.php" class="btn btn-outline-secondary w-100">
            Create an Account
          </a>
        </div>
      </form>
    </div>

    <!-- bootstrap cdn -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
