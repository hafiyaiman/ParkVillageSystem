<?php
session_start();
require('../config.php');
require('../functions.php');

$isLoggedIn = isset($_SESSION['user_id']);

$bookingData = [];

if ($isLoggedIn) {
    $user_id = $_SESSION['user_id'];

    // Get user details
    $userDetails = getUserDetails($conn, $user_id);
    $bookingData = getBookingDataByUserId($conn, $user_id);
    $userEmail = $userDetails['email'];

    // Get customer details
    $customerDetails = getCustomerDetails($conn, $user_id);
    $userName = $customerDetails['Name'];
    $userPnum = $customerDetails['Pnum'];
    $userAddress = $customerDetails['Address'];
}

// if (is_array($bookingData) && count($bookingData) > 0) {
//     foreach ($bookingData as $booking) {
//     }
// } else {
//     echo "No booking data found for the user.";
// }

// if (!empty($bookingData)) {
//     foreach ($bookingData as $booking) {
//         // Your existing code for displaying booking data
//     }
// } else {
//     // echo "<tr><td colspan='17'>No booking data available</td></tr>";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>D'Park Village</title>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./assets/css/global-header.css">
	<link rel="stylesheet" href="./assets/css/global-footer.css">
	<link rel="stylesheet" href="./assets/css/park.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

	<link rel="shortcut icon" href="./assets/img/favicon.webp" type="image/x-icon">

    <style>
        .action-column {
			text-align: center;
		}

		.action-column .btn-group {
			display: flex;
			justify-content: center;
		}

		.action-column .btn-group .btn {
			margin-right: 3px;
		}

        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        header {
    
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header-container {
        
        }

        .special-offers {
           
            margin-top: 20px;
        }

        .special-offers {
    display: flex;
    justify-content: center;
}

    #bookingTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        max-width: 100%;
    }

    #bookingTable th,
    #bookingTable td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    #bookingTable th {
        background-color: #333;
        color: #fff;
    }

        footer {
            /* Add your footer styles here */
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
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
                    <li class="header-nav-list"><a class="header-nav-link header-active"
                            href="customer_booking.php">Customer Booking</a></li>
                    <li class="header-nav-list"><a class="header-nav-link" href="profile.php">Profile</a></li>
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

    </header>
    <main>
        <div class="container">

            <div class="page-header-container">
                <h2 class="page-header">Booking</h2>
                <hr />
                <p class="page-sub-header">
                   
                </p>
            </div>

            
            <section class="special-offers">
            <table id="bookingTable" class="display mx-auto">
        <thead>
            <tr>
                <th>Name</th>
                <th>Book ID</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Vehicle Model</th>
                <th>Plate Number</th>
                <th>Date IN</th>
                <th>Date OUT</th>
                <th>Departure Number</th>
                <th>Arrival Number</th>
                <th>KLIA</th>
                <th>Parking Type</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
if (!empty($bookingData)) {
    foreach ($bookingData as $booking) {
        echo "<tr>";
        echo "<td>" . (isset($booking['customer_Name']) ? $booking['customer_Name'] : '') . "</td>";
        echo "<td>" . (isset($booking['Book_ID']) ? $booking['Book_ID'] : '') . "</td>";
        echo "<td>" . (isset($booking['customer_Pnum']) ? $booking['customer_Pnum'] : '') . "</td>";
        echo "<td>" . (isset($booking['customer_Address']) ? $booking['customer_Address'] : '') . "</td>";
        echo "<td>" . (isset($booking['vehicle_Model']) ? $booking['vehicle_Model'] : '') . "</td>";
        echo "<td>" . (isset($booking['vehicle_Plate_Number']) ? $booking['vehicle_Plate_Number'] : '') . "</td>";
        echo "<td>" . (isset($booking['Date_IN']) ? $booking['Date_IN'] : '') . "</td>";
        echo "<td>" . (isset($booking['Date_OUT']) ? $booking['Date_OUT'] : '') . "</td>";
        echo "<td>" . (isset($booking['Depart_no']) ? $booking['Depart_no'] : '') . "</td>";
        echo "<td>" . (isset($booking['Arrive_no']) ? $booking['Arrive_no'] : '') . "</td>";
        echo "<td>" . (isset($booking['KLIA']) ? $booking['KLIA'] : '') . "</td>";
        echo "<td>" . (isset($booking['parkType']) ? $booking['parkType'] : '') . "</td>";
        echo "<td>" . (isset($booking['duration']) ? $booking['duration'] : '') . "</td>";
        echo "<td>" . (isset($booking['payment_Amount']) ? $booking['payment_Amount'] : '') . "</td>";
        echo "<td>" . (isset($booking['payment_Payment_Method']) ? $booking['payment_Payment_Method'] : '') . "</td>";
        echo "<td>" . (isset($booking['payment_payment_status']) ? $booking['payment_payment_status'] : '') . "</td>";
        echo "<td class='action-column'>
                  <div class='btn-group'>
                      <button type='button' class='btn btn-sm btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          Action
                      </button>
                      <div class='dropdown-menu'>
                          <a class='dropdown-item edit_data' href='javascript:void(0)' data-id='{$booking['Book_ID']}'><span class='fa fa-edit text-primary'></span> Edit</a>
                          <a class='dropdown-item delete_data' href='javascript:void(0)' data-id='{$booking['Book_ID']}'><span class='fa fa-trash text-danger'></span> Delete</a>
                      </div>
                  </div>
              </td>";
        echo "</tr>";
    }
    
} else {
    echo "<tr><td colspan='17'>No booking data available</td></tr>";
}
?>
            
        </tbody>
    </table>
            </section>

            <div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="editForm">
            <input type="hidden" id="editBookId" name="editBookId">

            <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" class="form-control" id="editName" name="editName">
            </div>
            <div class="form-group">
                <label for="editPnum">Phone Number</label>
                <input type="text" class="form-control" id="editPnum" name="editPnum">
            </div>
            <div class="form-group">
                <label for="editAddress">Address</label>
                <input type="text" class="form-control" id="editAddress" name="editAddress">
            </div>
            <div class="form-group">
                <label for="editVehicleModel">Vehicle Model</label>
                <input type="text" class="form-control" id="editVehicleModel" name="editVehicleModel">
            </div>
            <div class="form-group">
                <label for="editPlateNumber">Plate Number</label>
                <input type="text" class="form-control" id="editPlateNumber" name="editPlateNumber">
            </div>
            <div class="form-group">
                <label for="editDateIn">Date IN</label>
                <input type="text" class="form-control" id="editDateIn" name="editDateIn">
            </div>
            <div class="form-group">
                <label for="editDateOut">Date OUT</label>
                <input type="text" class="form-control" id="editDateOut" name="editDateOut">
            </div>
            <div class="form-group">
                <label for="editDepartureNumber">Departure Number</label>
                <input type="text" class="form-control" id="editDepartureNumber" name="editDepartureNumber">
            </div>
            <div class="form-group">
                <label for="editArrivalNumber">Arrival Number</label>
                <input type="text" class="form-control" id="editArrivalNumber" name="editArrivalNumber">
            </div>
            <div class="form-group">
                <label for="editKLIA">KLIA</label>
                <input type="text" class="form-control" id="editKLIA" name="editKLIA">
            </div>
            <div class="form-group">
                <label for="editParkingType">Parking Type</label>
                <input type="text" class="form-control" id="editParkingType" name="editParkingType">
            </div>
            <div class="form-group">
                <label for="editDuration">Duration</label>
                <input type="text" class="form-control" id="editDuration" name="editDuration">
            </div>
            <div class="form-group">
                <label for="editAmount">Amount</label>
                <input type="text" class="form-control" id="editAmount" name="editAmount">
            </div>
            <div class="form-group">
                <label for="editPaymentMethod">Payment Method</label>
                <input type="text" class="form-control" id="editPaymentMethod" name="editPaymentMethod">
            </div>
            <div class="form-group">
                <label for="editPaymentStatus">Payment Status</label>
                <input type="text" class="form-control" id="editPaymentStatus" name="editPaymentStatus">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>

            </div>
        </div>
    </div>
</div>



<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this booking?</p>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>


        </div>
    </main>

    <footer class="footer">
		<div class="footer-container">
			<nav class="footer-nav">
				<div class="footer-description">
					<h3 class="footer-description-title">Star Hotels</h3>
					<p>Hospitality and Comfort are our watchwords</p>
				</div>
				<div class="footer-contact-us">
					<h3 class="footer-description-title">Contact Us</h3>
					<p class="footer-description-detail"> 
						<img src="./assets/img/map-pin.svg" class="footer-description-icon" alt="star hotel location">

						<span>23, Fola Osibo, Lekki Phase 1</span></p>
					<p class="footer-description-detail">
						<img src="./assets/img/phone.svg" class="footer-description-icon" alt="star hotels phone number"> 
						<span>
					 08185956620</span></p>
					<p class="footer-description-detail">
						<img src="./assets/img/mail.svg" class="footer-description-icon" alt="star hotels email">
						<span>support@starhotels.com</span> </p>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>



    <script>

    $(document).ready(function () {
        $('#bookingTable').DataTable();

        $('.edit_data').on('click', function () {
        var bookId = $(this).data('id');
        console.log('Clicked Edit button for bookId:', bookId);

        $.ajax({
    url: 'get_booking_details.php',
    method: 'POST',
    data: { bookId: bookId },
    dataType: 'json',
    success: function (response) {
        console.log(response.data);

        if (response.status == 'success') {
            var data = response.data;

            // Populate the form fields in the edit modal
            $('#editBookId').val(bookId);
            $('#editName').val(data.customer_name);
            $('#editPnum').val(data.customer_phone);
            $('#editAddress').val(data.customer_address);
            $('#editVehicleModel').val(data.vehicle_model);
            $('#editPlateNumber').val(data.vehicle_plate_number);
            $('#editDateIn').val(data.Date_IN);
            $('#editDateOut').val(data.Date_OUT);
            $('#editDepartureNumber').val(data.Depart_no);
            $('#editArrivalNumber').val(data.Arrive_no);
            $('#editKLIA').val(data.KLIA);
            $('#editParkingType').val(data.parkType);
            $('#editDuration').val(data.duration);
            $('#editAmount').val(data.payment_amount);
            $('#editPaymentMethod').val(data.payment_method);
            $('#editPaymentStatus').val(data.payment_status);

            // Show the edit modal
            $('#editModal').modal('show');
        } else {
            alert('Failed to fetch booking details');
        }
    },
    error: function (error) {
        console.log('Error fetching booking details: ', error);
    }
});

    });

});

    
document.getElementById('editForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Get values from the form
    var bookId = $('#editBookId').val();
    var name = $('#editName').val();
    var phoneNumber = $('#editPnum').val();
    var address = $('#editAddress').val();
    var vehicleModel = $('#editVehicleModel').val();
    var plateNumber = $('#editPlateNumber').val();
    var dateIn = $('#editDateIn').val();
    var dateOut = $('#editDateOut').val();
    var departureNumber = $('#editDepartureNumber').val();
    var arrivalNumber = $('#editArrivalNumber').val();
    var klia = $('#editKLIA').val();
    var parkingType = $('#editParkingType').val();
    var duration = $('#editDuration').val();
    var amount = $('#editAmount').val();
    var paymentMethod = $('#editPaymentMethod').val();
    var paymentStatus = $('#editPaymentStatus').val();

    // Create a FormData object and append form values
    var formData = new FormData();
    formData.append('editBookId', bookId);
    formData.append('editName', name);
    formData.append('editPnum', phoneNumber);
    formData.append('editAddress', address);
    formData.append('editVehicleModel', vehicleModel);
    formData.append('editPlateNumber', plateNumber);
    formData.append('editDateIn', dateIn);
    formData.append('editDateOut', dateOut);
    formData.append('editDepartureNumber', departureNumber);
    formData.append('editArrivalNumber', arrivalNumber);
    formData.append('editKLIA', klia);
    formData.append('editParkingType', parkingType);
    formData.append('editDuration', duration);
    formData.append('editAmount', amount);
    formData.append('editPaymentMethod', paymentMethod);
    formData.append('editPaymentStatus', paymentStatus);

    $.ajax({
        url: 'update_booking.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.includes('success')) {
        alert('Data Updated');
        location.reload();
        $('#editModal').modal('hide');
    } else {
        alert('Failed to update data');
    }
        },
        error: function (error) {
            console.log('Error updating data: ', error);
        }
    });
});




$(document).ready(function () {
    // DataTable initialization and other code...

    // Edit button click event
    $('.edit_data').on('click', function () {
        // Existing edit button code...
    });

    // Delete button click event
    $('.delete_data').on('click', function () {
        var bookId = $(this).data('id');
        console.log('Clicked Delete button for bookId:', bookId);

        // Show the delete confirmation modal
        $('#deleteModal').modal('show');

        // Set the bookId to be deleted in the modal's data attribute
        $('#confirmDelete').data('bookId', bookId);
    });

    // Confirm delete button click event
    $('#confirmDelete').on('click', function () {
        // Get the bookId from the data attribute
        var bookId = $(this).data('bookId');

        // Perform the AJAX request to delete the data
        $.ajax({
            url: 'delete_booking.php',
            method: 'POST',
            data: { bookId: bookId },
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.status == 'success') {
                    alert('Data Deleted');
                  location.reload();
                } else {
                    alert('Failed to delete data');
                }
            },
            error: function (error) {
                console.log('Error deleting data: ', error);
            }
        });

        // Hide the delete confirmation modal
        $('#deleteModal').modal('hide');
    });
});




</script>

</body>

</html>