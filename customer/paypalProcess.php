<?php
session_start();
require('../config.php');
require('../functions.php');

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parkingType = $_POST["Ptype"];
    $arrivalDate = $_POST["arrivalDate"];
    $departureDate = $_POST["departureDate"];
    $vehiclePlateNumber = $_POST["vehiclePlateNumber"];
    $vehicleType = $_POST["vehicleType"];
    $klia = $_POST["klia"];
    $flightDeparture = $_POST["flightDeparture"];
    $flightArrival = $_POST["flightArrival"];
    $depositAmount = $_POST["depositAmount"];
    $parkingTypeId = ($parkingType == 'roof_parking') ? 1 : (($parkingType == 'noroof_parking') ? 2 : 0);

    $user_id = $_SESSION['user_id'];

    if ($isLoggedIn) {
        $user_id = $_SESSION['user_id'];

        $userDetails = getUserDetails($conn, $user_id);
        $userEmail = $userDetails['email'];

        $customerDetails = getCustomerDetails($conn, $user_id);
        $userName = $customerDetails['Name'];
        $userPnum = $customerDetails['Pnum'];
        $userAddress = $customerDetails['Address'];
    }

    // Calculate duration in days
    $datetime1 = new DateTime($arrivalDate);
    $datetime2 = new DateTime($departureDate);
    $duration = $datetime1->diff($datetime2)->days;

    $pricePerDay = 0; 

    $priceQuery = $conn->prepare("SELECT price FROM parking WHERE parking_type = ?");
    $priceQuery->bind_param("s", $parkingType);
    $priceQuery->execute();
    $priceQuery->bind_result($price);

    if ($priceQuery->fetch()) {
        $pricePerDay = $price;
    }

    $priceQuery->close();

    $paymentAmount = $duration * $pricePerDay;

    try {
        $conn->autocommit(FALSE); 

        $stmt = $conn->prepare("INSERT INTO customer (Name, Pnum, Address, User_ID, deposit_paid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $userName, $userPnum, $userAddress, $user_id, $depositAmount);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting into customer table: " . $stmt->error);
        }
        $cust_id = $conn->insert_id;

        $stmt = $conn->prepare("INSERT INTO vehicle (Cust_ID, Model, Plate_Number) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $cust_id, $model, $vehiclePlateNumber);
        $model = $vehicleType;
        $vehiclePlateNumber = $vehiclePlateNumber;
        if (!$stmt->execute()) {
            throw new Exception("Error inserting into vehicle table: " . $stmt->error);
        }
        $vehicle_id = $conn->insert_id;

        // Subtract available parking slots based on parking type
        $subtractSlotsStmt = $conn->prepare("UPDATE parking SET numpark_available = numpark_available - 1 WHERE parking_type = ?");
        $subtractSlotsStmt->bind_param("s", $parkingType);
        if (!$subtractSlotsStmt->execute()) {
            throw new Exception("Error updating parking slots: " . $subtractSlotsStmt->error);
        }
        $subtractSlotsStmt->close();

        $paymentMethod = "paypal"; 
        $paymentStatus = "pending"; 

        $stmt = $conn->prepare("INSERT INTO payment (Cust_ID, Book_ID, Amount, Payment_Method, Payment_Status, deposit) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissi", $cust_id, $booking_id, $paymentAmount, $paymentMethod, $paymentStatus, $depositAmount);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting into payment table: " . $stmt->error);
        }
        $payment_id = $conn->insert_id; 
        $stmt->close();
        
        $stmt = $conn->prepare("INSERT INTO booking (Cust_ID, Vehicle_ID, Date_IN, Date_OUT, Depart_no, Arrive_no, KLIA, parkType, Duration, Payment_ID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssssssi", $cust_id, $vehicle_id, $arrivalDate, $departureDate, $flightDeparture, $flightArrival, $klia, $parkingType, $duration, $payment_id);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting into booking table: " . $stmt->error);
        }
        $booking_id = $conn->insert_id;

        // Insert data into parking_availability table
        $availabilityStmt = $conn->prepare("INSERT INTO parking_availability (Cust_ID, parking_type, date_start, date_end) VALUES (?, ?, ?, ?, ?)");
        $availabilityStmt->bind_param("iissi", $cust_id,  $parkingTypeId, $arrivalDate, $departureDate, $booking_id);
        if (!$availabilityStmt->execute()) {
            throw new Exception("Error inserting into parking_availability table: " . $availabilityStmt->error);
        }
        $availabilityStmt->close();

        $conn->commit(); 

        echo "Payment successful! Data inserted into the database, and parking slots updated.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        $conn->autocommit(TRUE); 
    }
} else {
    echo "Invalid request.";
}
?>
