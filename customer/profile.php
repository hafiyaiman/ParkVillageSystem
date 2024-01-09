<?php
session_start();

require('../config.php');
require('../functions.php');

$isLoggedIn = isset($_SESSION['user_id']);

if ($isLoggedIn) {
    $user_id = $_SESSION['user_id'];

    // Get user details
    $userDetails = getUserDetails($conn, $user_id);
    $userEmail = $userDetails['email'];
    $userpassword = $userDetails['password'];
    // Get customer details

    $customerDetails = getCustomerDetails($conn, $user_id);
    $userName = $customerDetails['Name'];
    $userPnum = $customerDetails['Pnum'];
    $userAddress = $customerDetails['Address'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/global-header.css">
    <link rel="stylesheet" href="./assets/css/global-footer.css">
    <link rel="stylesheet" href="./assets/css/park.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <link rel="shortcut icon" href="./assets/img/favicon.webp" type="image/x-icon">

    <meta charset="utf-8">
    <title>Account Settings or Edit Profile - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body { 
            margin: 0;
            padding-top: 40px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <nav class="header-nav-bar">
                <div class="header-nav-logo">
                    <a href="index.html">
                        <!-- <img src=""
                            alt="logo">
                    </a> -->
                </div>
                <ul class="header-nav-lists">
                    <li class="header-nav-list">
                        <a class="header-nav-link" href="home.php">Home</a>
                    </li>
                    <li class="header-nav-list"><a class="header-nav-link" href="customer_booking.php">Customer Booking</a></li>
                    <li class="header-nav-list"><a class="header-nav-link header-active"
                            href="profile.php">Profile</a></li>
                    <li class="header-nav-list">
                        <?php if ($isLoggedIn): ?>
                            <!-- If user is logged in, show Log Out button -->
                            <a class="header-btn header-btn-custom" href="../logout.php">Log Out</a>
                        <?php else: ?>
                            <!-- If user is not logged in, show Log In button -->
                            <a class="header-btn header-btn-custom" href="../index.php">Log In</a>
                        <?php endif; ?>
                    </li>
                </ul>

                <div class="header-hamburger-icon">
                    <div class="header-hamburger-line-1"></div>
                    <div class="header-hamburger-line-2"></div>
                    <div class="header-hamburger-line-3"></div>
                </div>
            </nav>

        </div>
    </header>
    <form action="" method="POST" id="updateProfileForm">
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="User Avatar">
                                </div>
                                <h5 class="user-name"><?php echo $userName; ?></h5>
                                <h6 class="user-email"><?php echo $userEmail; ?></h6>
                            </div>
                            <div class="about">
                                <h5>About</h5>
                                <p><?php echo $userName; ?> - Thank you for choosing our service.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <!-- Add an Edit button to enable editing -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary" id="editProfileBtn">Edit Profile</button>
                                </div>
                            </div>

                            <!-- Your existing form fields with the 'readonly' attribute removed -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Name">Full Name</label>
                                    <input type="text" class="form-control" id="Name" placeholder="<?php echo $userName; ?>" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="<?php echo $userEmail; ?>" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Pnum">Phone</label>
                                    <input type="text" class="form-control" id="Pnum" placeholder="<?php echo $userPnum; ?>" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="<?php echo $userpassword; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Street</label>
                                    <input type="name" class="form-control" id="Address" placeholder="<?php echo $userAddress; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="updateProfileBtn" name="updateProfileBtn">Update</button>

    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        </form>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="footer">
            <div class="footer-container">
                <nav class="footer-nav">
                    <div class="footer-description">
                        <h3 class="footer-description-title">D'Park Village</h3>
                        <p>Provide a affordable parking</p>
                    </div>
                    <div class="footer-contact-us">
                        <h3 class="footer-description-title">Contact Us</h3>
                        <p class="footer-description-detail">
                            <img src="./assets/img/map-pin.svg" class="footer-description-icon"
                                alt="star hotel location">

                            <span>NAGU ,25 </span>
                        </p>
                        <p class="footer-description-detail">
                            <img src="./assets/img/phone.svg" class="footer-description-icon"
                                alt="star hotels phone number">
                            <span>
                                08185956620</span>
                        </p>
                        <p class="footer-description-detail">
                            <img src="./assets/img/mail.svg" class="footer-description-icon" alt="star hotels email">
                            <span>support@parkingVillage.com</span>
                        </p>
                    </div>
                    <div class="footer-follow-us">
                        <h3 class="footer-description-title">Follow Us</h3>
                        <ul class="footer-follow-us-lists">
                            <li class="follow-us-list">
                                <a href="">
                                    <img src="./assets/img/facebook.svg" alt="star hotels facebook page">
                                </a>
                            </li>
                            <li class="follow-us-list">
                                <a href="">
                                    <img src="./assets/img/twitter.svg" alt="star hotels twitter page">
                                </a>
                            </li>
                            <li class="follow-us-list">
                                <a href="">
                                    <img src="./assets/img/instagram.svg" alt="star hotels instagram page">
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </footer>


		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    console.log("Document ready");

    // Hide the update button initially
    $('#updateProfileBtn').hide();

    // Disable editing of form fields
    $('input').prop('readonly', true);

    // Event listener for the edit button
    $('#editProfileBtn').on('click', function () {
        // Enable editing of form fields
        $('input').prop('readonly', false);
        // Show the update button
        $('#updateProfileBtn').show();
        // Hide the edit button
        $(this).hide();
    });
   
    document.getElementById('updateProfileForm').addEventListener('submit', function (event) {
        event.preventDefault();
        console.log("Submitting form...");

        var Name = $('#Name').val();
        var email = $('#email').val();
        var Pnum = $('#Pnum').val();
        var password = $('#password').val();
        var Address = $('#Address').val();
        console.log("Name value:", Name);

        var formData = new FormData();
        formData.append('Name', Name);
        formData.append('email', email);
        formData.append('Pnum', Pnum);
        formData.append('password', password);
        formData.append('Address', Address); 
        

        $.ajax({
        type: 'POST',
        url: 'updateprogress.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log("Submitting form...", formData);
            console.log(response);
            console.log(response.status + ': ' + response.message);
            location.reload();
            $('input').prop('readonly', true);
            // Show the edit button
            $('#editProfileBtn').show();
            // Hide the update button
            $('#updateProfileBtn').hide();
        },
        error: function (error) {
            console.log(error);
        }
    });
});
  
});

 

</script>
</body>

</html>
