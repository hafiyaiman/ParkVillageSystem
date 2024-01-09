<?php
require('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized and validated your inputs before updating the database
    $bookId = $_POST['editBookId'];
    $customerName = $_POST['editName'];
    $customerPhone = $_POST['editPnum'];
    $customerAddress = $_POST['editAddress'];
    $vehicleModel = $_POST['editVehicleModel'];
    $plateNumber = $_POST['editPlateNumber'];
    $dateIn = $_POST['editDateIn'];
    $dateOut = $_POST['editDateOut'];
    $departureNumber = $_POST['editDepartureNumber'];
    $arrivalNumber = $_POST['editArrivalNumber'];
    $klia = $_POST['editKLIA'];
    $parkingType = $_POST['editParkingType'];
    $duration = $_POST['editDuration'];
    $amount = $_POST['editAmount'];
    $paymentMethod = $_POST['editPaymentMethod'];
    $paymentStatus = $_POST['editPaymentStatus'];

   // Update customer table
$queryCustomer = "UPDATE customer
SET Name = ?, Pnum = ?, Address = ?
WHERE Book_ID = ?";

$stmtCustomer = $conn->prepare($queryCustomer);
$stmtCustomer->bind_param("ssss", $customerName, $customerPhone, $customerAddress, $bookId);
$stmtCustomer->execute();
$stmtCustomer->close();


    // Update vehicle table
    $queryVehicle = "UPDATE vehicle
                     SET Model = ?, Plate_Number = ?
                     WHERE Cust_ID = (SELECT Cust_ID FROM booking WHERE Book_ID = ?)";

    $stmtVehicle = $conn->prepare($queryVehicle);
    $stmtVehicle->bind_param("ssi", $vehicleModel, $plateNumber, $bookId);
    $stmtVehicle->execute();
    $stmtVehicle->close();

    // Update payment table
    $queryPayment = "UPDATE payment
                     SET Amount = ?, Payment_Method = ?, payment_status = ?
                     WHERE Cust_ID = (SELECT Cust_ID FROM booking WHERE Book_ID = ?)";

    $stmtPayment = $conn->prepare($queryPayment);
    $stmtPayment->bind_param("sssi", $amount, $paymentMethod, $paymentStatus, $bookId);
    $stmtPayment->execute();
    $stmtPayment->close();

// Update booking table
$queryBooking = "UPDATE booking
                 SET Date_IN = ?, Date_OUT = ?, Depart_no = ?, Arrive_no = ?, KLIA = ?, status_booking = ?
                 WHERE Book_ID = ?";

$stmtBooking = $conn->prepare($queryBooking);
$stmtBooking->bind_param("ssssssi", $dateIn, $dateOut, $departureNumber, $arrivalNumber, $klia, $parkingType, $bookId);
$stmtBooking->execute();
$stmtBooking->close();

    // Update successful
    $response = ['status' => 'success', 'message' => 'Booking details updated successfully'];

    $conn->close();

    echo json_encode($response);
} else {
    // If not a POST request, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
