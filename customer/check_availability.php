<?php
session_start();
require('../config.php');
require('../functions.php');

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $isLoggedIn) {
    $departureDate = $_POST["departureDate"];
    $arrivalDate = $_POST["arrivalDate"];
    $parkingType = $_POST["parkingType"];

    // Check parking availability based on the date range and parking type
    $availabilityQuery = $conn->prepare("SELECT COUNT(*) FROM parking_availability WHERE parking_type = ? AND date_start <= ? AND date_end >= ?");
    $availabilityQuery->bind_param("sss", $parkingType, $arrivalDate, $departureDate);
    $availabilityQuery->execute();
    $availabilityQuery->bind_result($availabilityCount);
    $availabilityQuery->fetch();
    $availabilityQuery->close();

    // Retrieve the total available slots for the parking type
    $totalSlotsQuery = $conn->prepare("SELECT numpark_available FROM parking WHERE parking_type = ?");
    $totalSlotsQuery->bind_param("s", $parkingType);
    $totalSlotsQuery->execute();
    $totalSlotsQuery->bind_result($totalSlots);
    $totalSlotsQuery->fetch();
    $totalSlotsQuery->close();

    // Calculate the updated availability
    $updatedAvailability = $totalSlots - $availabilityCount;

    // Return JSON response with updated availability information
    $availabilityInfo = [
        'updatedAvailability' => $updatedAvailability
    ];

    echo json_encode($availabilityInfo);
} else {
    echo "Invalid request or user not logged in.";
}
?>
