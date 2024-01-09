<?php
session_start();
require('../config.php');
require('../functions.php');

$isLoggedIn = isset($_SESSION['user_id']);

$parkingSlotData = getParkingSlotData($conn);

$userName = "";
$userEmail = "";
$userPnum = "";
$userAddress = "";

if ($isLoggedIn) {
    $user_id = $_SESSION['user_id'];

    $userDetails = getUserDetails($conn, $user_id);
    $userEmail = $userDetails['email'];

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
    <meta name="description" content="">
    <title>D Park Village</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/global-header.css">
    <link rel="stylesheet" href="./assets/css/global-footer.css">
    <link rel="stylesheet" href="./assets/css/accesibility.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/park.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="./assets/img/favicon.webp" type="image/x-icon">
	<style>

		.jumbotron-form label {
   display: block;
   margin-bottom: 5px;
}

.jumbotron-form select {
   width: 80%;
   padding: 9px;
   margin-bottom: 10px;
}
#paymentModal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

#paymentModalContent {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    text-align: center; 
}

#btn-pay-cash,
#btn-pay-paypal {
    background-color: #d84b91;
    color: white;
    padding: 30px 35px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#btn-pay-cash:hover,
#btn-pay-paypal:hover {
    background-color: #FFB6C1;
}

#closeModalBtn {
    color: #888;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

#closeModalBtn:hover {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.available-parking {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: 15px;
    margin-top: 20px;
    border-radius: 8px;
}

.available-parking h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.available-parking p {
    margin: 5px 0;
    color: #666;
}



	</style>
</head>

<body class="scroll-bar">

    <div id="loader">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#d4af37"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                    to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    <header>
        <div class="header-container">
            <nav class="header-nav-bar">
                <div class="header-nav-logo">
                    <a href="index.php">
                        <!-- <img src="assets\img\logo.jpg"
							alt="star hotels logo" width="80"> -->
                    </a>
                </div>
                <ul class="header-nav-lists">
                    <li class="header-nav-list">
                        <a class="header-nav-link header-active" href="home.php">Home</a>
                    </li>
                    <li class="header-nav-list"><a class="header-nav-link"
                            href="customer_booking.php">Customer Booking</a></li>
					<li class="header-nav-list"><a class="header-nav-link" href="profile.php">Profile</a></li>
					<li class="header-nav-list">
    <?php if ($isLoggedIn): ?>
        <a class="header-btn header-btn-custom" href="../logout.php">Log Out</a>
    <?php else: ?>
    
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

        </div>
    </header>

    <div class="jumbotron-container">
        <div class="jumbotron-left">
            <h2 class="jumbotron-header">Discover the parking with the lowest price.</h2>
            <p>We are focused on providing clients with the convenient service<br>
                of comfort and excellent affordable rates</p>

        </div>
 <div class="jumbotron-right">
 <form action="" method="post" class="jumbotron-form" onsubmit="return validateForm()" id="paymentForm">

        <h3>Booking Form</h3>

            <label for="Ptype">Parking Type:</label>
            <select id="Ptype" name="parkingType" onfocus="checkLogin('Ptype')" required>
            <option value="" disabled selected>Please Select</option>
                <option id="roof" value="roof_parking">Rooftop Parking RM7/Day</option>
                <option id="noRoof" value="noroof_parking">Open Space Parking RM10/Day</option>
            </select>
            <input type="hidden" id="Cust_ID" name="Cust_ID" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
            <label for="Date_OUT">Departure Date:</label>
            <input type="date" id="Date_OUT" name="Date_OUT" placeholder="Departure Date"
                onfocus="checkLogin('Date_OUT')" required>

            <label for="Date_IN">Arrival Date:</label>
            <input type="date" id="Date_IN" name="Date_IN" placeholder="Arrival Date" onfocus="checkLogin('Date_IN')" onchange="checkAvailableSlots()" required>

            <label for="Depart_no">Flight Departure:</label>
            <input type="text" id="Depart_no" name="Depart_no" placeholder="Flight Departure"
                onfocus="checkLogin('Depart_no')" required>

            <label for="Arrive_no">Flight Arrival:</label>
            <input type="text" id="Arrive_no" name="Arrive_no" placeholder="Flight Arrival"
                onfocus="checkLogin('Arrive_no')" required>

            <label for="Plate_Number">Vehicle Plate Number:</label>
            <input type="text" id="Plate_Number" name="Plate_Number" placeholder="Vehicle Plate Number"
                onfocus="checkLogin('Plate_Number')" required>

            <label for="Model">Vehicle Type:</label>
            <input type="text" id="Model" name="Model" placeholder="Vehicle Type" onfocus="checkLogin('Model')" required>

            <label for="KLIA">KLIA:</label>
            <select id="KLIA" name="KLIA" onfocus="checkLogin('KLIA')" required>
            <option value="" disabled selected>Please Select</option>
                <option value="KLIA1">KLIA1</option>
                <option value="KLIA2">KLIA2</option>
            </select>

            <button type="button" id="btn-submit" class="rates"  onclick="validateAndOpenPaymentModal()">Book</button>

        </form>
    </div>
    </div>

	<div id="paymentModal">
    <div id="paymentModalContent">
    <span id="closeModalBtn" onclick="closePaymentModal()">&times;</span>
    <h2>Choose Payment Option</h2>
    <p><strong>Note: A deposit is required to complete the booking.</strong></p><br>
  
    <label for="depositAmount">Deposit Amount (RM):</label>
    <input type="number" id="depositAmount" name="depositAmount" placeholder="Enter deposit amount" required><br></br>
  
    <input type="hidden" id="paymentMethod" name="paymentMethod" value="">
        
    <button id="btn-pay-cash" onclick="processPayment('cash')">Pay with Cash</button>
    <button id="btn-pay-paypal" onclick="redirectToPayPal('paypal')">Pay with PayPal</button>
        
    <br><br>
</div>
</div>




    <div class="row center-lg">

        <div class="col">
            <h3 class="offers-title">Parking Category</h3>
            <p class="offers-sub-title">
                Choose Your Parking Category
            </p>
        </div>
    </div>
    </section>

    <!-- Rooms -->
    <section class="rooms-section">
        <div class="row room-section-header-container">
            <div class="col col-3">
                <h4 class="room-section-header active-header" id="standard-room">Standard Parking</h4>
            </div>
        </div>
        <div class="row center-lg">

            <div class="rooms col col-2">
                <img src="assets/img/noroof.jpg" alt="" class="rooms-img" width="350" height="300">

                <h3 class="room-title">Open Space Parking</h3>
                <p class="room-text">Designed specifically for Practicality and <br> comfort</p>
                <p class="amount-text">RM7 Per Day</p>
                <!-- <div class="buttons-container">
						  <a href="https://timbu.com/search?query=hotel" class="btn btn-fill">Book</a>
					  </div> -->
            </div>
            <div class="rooms col col-2">
                <img src="assets/img/roof.jpg" alt="" class="rooms-img" width="350" height="300">
                <h3 class="room-title">Roof Parking</h3>
                <p class="room-text">Designed specifically for Practicality and <br> comfort</p>
                <p class="amount-text">RM10 Per Day</p>
                <!-- <div class="buttons-container">
						  <a href="https://timbu.com/search?query=hotel" class="btn btn-fill">Book</a>
					  </div> -->
            </div>
        </div>
    </section>

    </div>
    <section class="special-offers">
        <!-- Top Text -->
        <div class="page-header-container">



        </div>
        </div>
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
        <script defer async>
        (() => {
            const loader = document.getElementById('loader');
            const scrollBar = document.getElementsByClassName('scroll-bar')[0];
            window.addEventListener('load', () => {
                loader.classList.add('none');
                scrollBar.classList.remove('scroll-bar')
            });
        })();

		function checkLogin(fieldName) {
          
            var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;

            if (!isLoggedIn) {
                alert("Please login first!");
                document.getElementById(fieldName).blur(); 
            }
        }
        </script>
    <script>

function validateAndOpenPaymentModal() {
        if (validateForm()) {
            openPaymentModal();
        }
    }

    function validateForm() {
        var parkingType = document.getElementById('Ptype').value;
        var arrivalDate = document.getElementById('Date_IN').value;
        var departureDate = document.getElementById('Date_OUT').value;
        var flightDeparture = document.getElementById('Depart_no').value;
        var flightArrival = document.getElementById('Arrive_no').value;
        var vehiclePlateNumber = document.getElementById('Plate_Number').value;
        var vehicleType = document.getElementById('Model').value;
        var klia = document.getElementById('KLIA').value;

        if (parkingType === '') {
            alert('Please select the parking type.');
            return false;
        }


        if (arrivalDate.trim() === '') {
            alert('Please enter the arrival date.');
            return false;
        }

        if (departureDate.trim() === '') {
            alert('Please enter the departure date.');
            return false;
        }

        if (flightDeparture.trim() === '') {
            alert('Please enter the flight departure.');
            return false;
        }

        if (flightArrival.trim() === '') {
            alert('Please enter the flight arrival.');
            return false;
        }

        if (vehiclePlateNumber.trim() === '') {
            alert('Please enter the vehicle plate number.');
            return false;
        }

        if (vehicleType.trim() === '') {
            alert('Please enter the vehicle type.');
            return false;
        }

       
        if (klia === '') {
            alert('Please select KLIA.');
            return false;
        }


        return true;
    }

    function openPaymentModal() {
            var modal = document.getElementById('paymentModal');
            modal.style.display = 'block';
        }

        // function closePaymentModal() {
        //     var modal = document.getElementById('paymentModal');
        //     modal.style.display = 'none';
        // }

        function processPayment(paymentOption) {
    var depositAmount = document.getElementById('depositAmount');

if (!depositAmount || depositAmount.value.trim() === '') {
    alert('Please enter the deposit amount.');
    return;
}

    if (paymentOption == 'cash') {
        var depositAmount = document.getElementById('depositAmount').value;
        var Ptype = document.getElementById('Ptype').value;
        var arrivalDate = document.getElementById('Date_IN').value;
        var departureDate = document.getElementById('Date_OUT').value;
        var flightDeparture = document.getElementById('Depart_no').value;
        var flightArrival = document.getElementById('Arrive_no').value;
        var vehiclePlateNumber = document.getElementById('Plate_Number').value;
        var vehicleType = document.getElementById('Model').value;
        var klia = document.getElementById('KLIA').value;

        var formData = new FormData();
        formData.append('depositAmount', depositAmount);
        formData.append('Ptype', Ptype);
        formData.append('arrivalDate', arrivalDate);
        formData.append('departureDate', departureDate);
        formData.append('flightDeparture', flightDeparture);
        formData.append('flightArrival', flightArrival);
        formData.append('vehiclePlateNumber', vehiclePlateNumber);
        formData.append('vehicleType', vehicleType);
        formData.append('klia', klia);

        $.ajax({
            type: 'POST',
            url: 'cashProcess.php',
            processData: false, 
            contentType: false, 
            data: formData,
            success: function (response) {
                response = response.trim(); 
                console.log('Response from server:', response);
                location.reload();

                alert('Payment successful! Data inserted into the database.');
                closePaymentModal();
            },
            error: function (xhr, status, error) {
                alert('Error occurred while processing the payment. Please check the console for details.');
                console.error('Error:', xhr, status, error);
            }
        });
    } else if (paymentOption === 'paypal') {
        console.log('Payment with PayPal');
        // closePaymentModal();
    }
}

        function checkAvailableSlots() {
        var parkingType = $("#Ptype").val();
        var departureDate = $("#Date_OUT").val();
        var arrivalDate = $("#Date_IN").val();
        var Cust_ID = $("#Cust_ID").val();
        console.log(Cust_ID);
        console.log(parkingType);

    $.ajax({
        type: 'POST',
        url: 'check_slots.php',
        data: { 
                parkingType: parkingType,
                departureDate: departureDate,
                arrivalDate: arrivalDate,
                Cust_ID: Cust_ID 
            },
        success: function (response) {
            response = response.trim(); // Trim any extra spaces
            console.log('Response from server:', response);

            if (response == 'available') {
                alert('Parking slots are available. You can proceed.');

            } else if (response === 'unavailable') {
                alert('Sorry, parking slots are not available for the selected type.');
        
                // Reset value
                $("#Ptype").val('');
                $("#Date_IN").val('');
                $("#Date_OUT").val('');
            } else {
                alert('Unexpected response from server. Please check the console for details.');
                console.error('Unexpected response:', response);
            }
        },
        error: function (xhr, status, error) {
            alert('Error occurred while checking available slots. Please check the console for details.');
            console.error('Error:', xhr, status, error);
        }
    });
}

function redirectToPayPal() {
    var depositAmount = document.getElementById('depositAmount').value;

    // Check if depositAmount is valid (you may want to add more validation)
    if (depositAmount.trim() === '') {
        alert('Please enter the deposit amount.');
        return;
    }

    // Get additional data
    var Ptype = document.getElementById('Ptype').value;
    var arrivalDate = document.getElementById('Date_IN').value;
    var departureDate = document.getElementById('Date_OUT').value;
    var flightDeparture = document.getElementById('Depart_no').value;
    var flightArrival = document.getElementById('Arrive_no').value;
    var vehiclePlateNumber = document.getElementById('Plate_Number').value;
    var vehicleType = document.getElementById('Model').value;
    var klia = document.getElementById('KLIA').value;

    // Set the paymentMethod hidden field value to 'paypal'
    document.getElementById('paymentMethod').value = 'paypal';

    // Redirect to paypal.php with depositAmount and additional data as query parameters
    var redirectUrl = 'paypal.php?' +
        'depositAmount=' + encodeURIComponent(depositAmount) +
        '&Ptype=' + encodeURIComponent(Ptype) +
        '&arrivalDate=' + encodeURIComponent(arrivalDate) +
        '&departureDate=' + encodeURIComponent(departureDate) +
        '&flightDeparture=' + encodeURIComponent(flightDeparture) +
        '&flightArrival=' + encodeURIComponent(flightArrival) +
        '&vehiclePlateNumber=' + encodeURIComponent(vehiclePlateNumber) +
        '&vehicleType=' + encodeURIComponent(vehicleType) +
        '&klia=' + encodeURIComponent(klia);

    window.location.href = redirectUrl;
}
		</script>
        <script defer async src="assets/js/toggleHamburger.js"></script>
</body>

</html>