<?php

  include "includes/includes.php";

  if(!isset($_SESSION['current_user'])){
    header("location: signin.php");
    exit();
  }else{
    $purchasedItems = $transaction->displayTransactionPerUser($connection, $_SESSION['current_user']['user_id']);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>
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
  <body class="hasBG">
    <div class="profile-page d-flex flex-column">
      <div class="profile-page-header bg-white">
        <div class="container d-flex py-3">
          <button
            onclick="window.history.back()"
            style="width: 40px; height: 40px; background-color: var(--bg-body)"
            class="btn rounded-circle border d-flex align-items-center justify-content-center p-0"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-chevron-left-icon lucide-chevron-left"
            >
              <path d="m15 18-6-6 6-6" />
            </svg>
          </button>

          <div class="ms-2 d-flex align-items-center">
            <img
              width="40"
              height="40"
              src="images/logo.png"
              alt=""
              class="ms-1"
            />
            <p class="mb-0 sidebar-label fw-bold fs-5">
              Digi<span class="text-primary">Cart</span>
            </p>
          </div>

          <a href="logout-logic.php" class="btn btn-danger ms-auto btn-sm px-4 m-0 d-flex align-items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-log-out-icon lucide-log-out me-1"
            >
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
              <polyline points="16 17 21 12 16 7" />
              <line x1="21" x2="9" y1="12" y2="12" />
            </svg>
            Log Out
          </a>
        </div>
      </div>

      <div
        class="d-flex justify-content-center align-items-center py-5 flex-column"
      >
        <h1 class="fw-semibold">Your Profile</h1>
        <p class="mb-0 text-center text-muted">
          View or edit your account's informations here.
        </p>
      </div>
      <div
        style="min-height: 75vh"
        class="profile-content bg-white py-5 border-bottom"
      >
        <div class="row container mx-auto">

          <!-- TABS IN LEFT AREA  -->
          <div class="col col-3 d-flex flex-column">
            <!-- tabs -->
            <div
              class="nav flex-column nav-pills mb-3 border p-4 rounded-2"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <button
                class="nav-link text-start text-black active mb-2"
                id="personal-info-tab"
                data-bs-toggle="pill"
                data-bs-target="#personal-info-content"
                type="button"
                role="tab"
                aria-controls="personal-info-content"
                aria-selected="true"
              >
                Personal Information
              </button>
              <button
                class="nav-link text-start text-black mb-2"
                id="orders-tab"
                data-bs-toggle="pill"
                data-bs-target="#orders-content"
                type="button"
                role="tab"
                aria-controls="orders-content"
                aria-selected="false"
              >
                Purchased Products
              </button>
              <button
                class="nav-link text-start text-black"
                id="changepassword-tab"
                data-bs-toggle="pill"
                data-bs-target="#changepassword-content"
                type="button"
                role="tab"
                aria-controls="changepassword-content"
                aria-selected="false"
              >
                Change Password
              </button>
            </div>
          </div>
          <div class="col col-9 border rounded-2 p-4">

            <!-- updating profile feedback  -->
            <?php 
                if(isset($_SESSION['update_error'])){
                    echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ' . $_SESSION["update_error"] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';

                    unset($_SESSION['update_error']);
                }
                if(isset($_SESSION['update_success'])){
                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ' . $_SESSION["update_success"] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';

                    unset($_SESSION['update_success']);
                }
            ?>

            <!-- content here -->
            <div class="tab-content" id="v-pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="personal-info-content"
                role="tabpanel"
                aria-labelledby="personal-info-tab"
              >
                
              <form action="update-profile-logic.php?user_id=<?= $_SESSION['current_user']['user_id'] ?>" method="POST" class="d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between">
                  <h4>Profile Informations</h4>
                  <button type="submit" class="btn btn-primary px-3 btn-sm py-2">Update Changes</button>
                </div>
                <div style="gap: 12px" class="d-flex">
                  <div class="mb-3 w-100">
                    <label for="firstname" class="form-label">First Name</label>
                    <input
                      value="<?= $_SESSION['current_user']['firstname'] ?>"
                      required
                      name="firstname"
                      type="text"
                      class="form-control"
                      id="firstname"
                      placeholder="Enter First Name"
                    />
                  </div>
                  <div class="mb-3 w-100">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input
                      value="<?= $_SESSION['current_user']['lastname'] ?>"
                      required
                      name="lastname"
                      type="text"
                      class="form-control"
                      id="lastname"
                      placeholder="Enter Last Name"
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="male" <?= $_SESSION['current_user']['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= $_SESSION['current_user']['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                  </select>
                </div>

                <div class="mb-3 mt-5">
                  <label for="barangay" class="form-label">Barangay</label>
                  <input
                    value="<?= $_SESSION['current_user']['barangay'] ?>"
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
                    value="<?= $_SESSION['current_user']['municipality'] ?>"
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
                    value="<?= $_SESSION['current_user']['province'] ?>"
                    required
                    name="province"
                    type="text"
                    class="form-control"
                    id="province"
                    placeholder="Enter Province"
                  />
                </div>
                
                <!-- Add hidden field for user_id -->
                <input type="hidden" name="user_id" value="<?= $_SESSION['current_user']['user_id'] ?>">
              </form>

              </div>
              <div
                class="tab-pane fade"
                id="orders-content"
                role="tabpanel"
                aria-labelledby="orders-tab"
              >
                <h4>Purchased Products</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-secondary" scope="col">Name</th>
                      <th class="text-secondary" scope="col">Price</th>
                      <th class="text-secondary" scope="col">Amount</th>
                      <th class="text-secondary" scope="col">Date</th>
                      <th class="text-secondary" scope="col">Download</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = $purchasedItems->fetch_assoc()): ?>
                      <tr>
                        <td><?=$row['product_name']?></td>
                        <td>₱<?=$row['price']?></td>
                        <td>₱<?=$row['total']?></td>
                        <td><?=$row['transaction_date']?></td>
                        <td>
                          <a class="bg-primary text-white rounded-1 py-1 px-3" href="https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx" download="Your_Filename.docx">Download
                          </a>
                        </td>
                      </tr>
                    <?php endwhile ?>
                  </tbody>
                </table>

                <!-- Add your orders content here -->
              </div>
              <div
                class="tab-pane fade"
                id="changepassword-content"
                role="tabpanel"
                aria-labelledby="changepassword-tab"
              >
                <h4>Change Password</h4>
                <p>Your password content goes here...</p>
                <!-- Add your orders content here -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FOOTER  -->
    <footer
      class="py-4 d-flex align-items-center justify-content-center bg-white"
    >
      <div class="container d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-muted d-flex align-items-center">
          <img src="images/logo.png" width="50" height="50" alt="" />Digi<span
            class="text-primary"
            >Cart</span
          >
        </h3>
        <p class="mb-0 text-secondary fw-bold">Mherafe Cabug@2025</p>
      </div>
    </footer>
  </body>

  <!-- bootstrap cdn -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</html>
