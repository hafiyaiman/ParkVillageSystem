<?php
session_start();
require('../config.php');
require('../functions.php');
//require('home.php');

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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve data from query parameters
    $depositAmount = $_GET['depositAmount'];
    $Ptype = $_GET['Ptype'];
    $arrivalDate = $_GET['arrivalDate'];
    $departureDate = $_GET['departureDate'];
    $flightDeparture = $_GET['flightDeparture'];
    $flightArrival = $_GET['flightArrival'];
    $vehiclePlateNumber = $_GET['vehiclePlateNumber'];
    $vehicleType = $_GET['vehicleType'];
    $klia = $_GET['klia'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page with PayPal Integration</title>
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Updated to a column layout */
            height: 100vh;
            background-color: #f4f4f4;
        }

        #btn-paypal-checkout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Display user details -->
    <div>
        <p>User Name: <?php echo $userName; ?></p>
        <p>Email: <?php echo $userEmail; ?></p>
        <p>Phone Number: <?php echo $userPnum; ?></p>
        <p>Address: <?php echo $userAddress; ?></p>
    </div>
    <!-- PayPal button will be rendered here using Javascript -->
    <div id="btn-paypal-checkout"></div>

    <script>
        // Echo PHP variables as JavaScript variables
        var depositAmount = <?php echo json_encode($depositAmount); ?>;
        var Ptype = <?php echo json_encode($Ptype); ?>;
        var arrivalDate = <?php echo json_encode($arrivalDate); ?>;
        var departureDate = <?php echo json_encode($departureDate); ?>;
        var flightDeparture = <?php echo json_encode($flightDeparture); ?>;
        var flightArrival = <?php echo json_encode($flightArrival); ?>;
        var vehiclePlateNumber = <?php echo json_encode($vehiclePlateNumber); ?>;
        var vehicleType = <?php echo json_encode($vehicleType); ?>;
        var klia = <?php echo json_encode($klia); ?>;

    // Call the redirectFromPaypal function with the PHP variables
    //redirectFromPaypal(depositAmount, Ptype, arrivalDate, departureDate, flightDeparture, flightArrival, vehiclePlateNumber, vehicleType, klia);

        window.addEventListener("load", function () {
            // Function to clear the PayPal button container
            function clearPayPalButton() {
                var paypalButtonContainer = document.getElementById('btn-paypal-checkout');
                paypalButtonContainer.innerHTML = ''; // Clear the content
            }

            // Function to render the PayPal button
            function renderPayPalButton(depositAmount) {
                // Render the PayPal button
                paypal.Button.render({
                    env: 'sandbox', // sandbox | production
                    style: {
                        label: 'checkout',
                        size: 'medium',
                        shape: 'pill',
                        color: 'gold',
                        layout: 'vertical'
                    },
                    client: {
                        sandbox: 'AWr5zm3H33JG36fzyM_016_aGGbXO0ivZKnk9Q7gp1OFfoZjI7gjnD21AjuFo--BhkI1jfPveiXSB24s',
                        production: 'AWr5zm3H33JG36fzyM_016_aGGbXO0ivZKnk9Q7gp1OFfoZjI7gjnD21AjuFo--BhkI1jfPveiXSB24s'
                    },
                    funding: {
                        allowed: [
                            paypal.FUNDING.CARD,
                            paypal.FUNDING.ELV
                        ]
                    },
                    payment: function (data, actions) {
                        // Use the deposit amount passed as a parameter
                        return actions.payment.create({
                            payment: {
                                transactions: [
                                    {
                                        amount: {
                                            total: depositAmount,
                                            currency: 'MYR'
                                        }
                                    }
                                ]
                            }
                        });
                    },
                    onAuthorize: function (data, actions) {
                    alert("Payment Success");
                    console.log("Payment authorized", data);
                    console.log("PayPal API Response:", data);
                    console.log("Order ID:", data.paymentID);

                    redirectFromPaypal(depositAmount, Ptype, arrivalDate, departureDate, flightDeparture, flightArrival, vehiclePlateNumber, vehicleType, klia);
                    },

                    onCancel: function (data, actions) {
                        alert("Payment cancelled");
                        console.log("Payment cancelled:", data);
                    }
                }, '#btn-paypal-checkout');
            }

            // Get the deposit amount from the URL query parameters
            var urlParams = new URLSearchParams(window.location.search);
            var depositAmount = urlParams.get('depositAmount');

            // Clear any existing PayPal button
            clearPayPalButton();
            // Render the PayPal button with the deposit amount
            renderPayPalButton(depositAmount);
        });

        function redirectFromPaypal(depositAmount, Ptype, arrivalDate, departureDate, flightDeparture, flightArrival, vehiclePlateNumber, vehicleType, klia) {
            // Use the parameters passed to the function
            var parkingType = Ptype;
            var arrivalDate = arrivalDate;
            var departureDate = departureDate;
            var flightDeparture = flightDeparture;
            var flightArrival = flightArrival;
            var vehiclePlateNumber = vehiclePlateNumber;
            var vehicleType = vehicleType;
            var klia = klia;

            var formData = new FormData();
            formData.append('depositAmount', depositAmount);
            formData.append('Ptype', parkingType);
            formData.append('arrivalDate', arrivalDate);
            formData.append('departureDate', departureDate);
            formData.append('flightDeparture', flightDeparture);
            formData.append('flightArrival', flightArrival);
            formData.append('vehiclePlateNumber', vehiclePlateNumber);
            formData.append('vehicleType', vehicleType);
            formData.append('klia', klia);

            $.ajax({
                type: 'POST',
                url: 'paypalProcess.php', // Update the URL to your actual processing script
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    response = response.trim();
                    console.log('Response from server:', response);
                    location.reload();

                    console.log('Payment successful! Data inserted into the database.');
                    window.location.href = 'customer_booking.php';
                    //closePaymentModal();
                },
                error: function (xhr, status, error) {
                console.log('Error occurred while processing the payment. Please check the console for details.');
                console.error('Error:', xhr, status, error);
                }
            });

            console.log('Form Data:', {
                parkingType,
                arrivalDate,
                departureDate,
                flightDeparture,
                flightArrival,
                vehiclePlateNumber,
                vehicleType,
                klia
            });
        }
    </script>
</body>
</html>
