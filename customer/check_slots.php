<?php
session_start();
require('../config.php');
require('../functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departureDate = $_POST['departureDate'];
    $arrivalDate = $_POST['arrivalDate'];
    $parkingType = $_POST['parkingType'];
    $parkingTypeId = ($parkingType == 'roof_parking') ? 1 : (($parkingType == 'noroof_parking') ? 2 : 0);

    $countQuery = "SELECT COUNT(*) as count_slots FROM parking_availability
                   WHERE parking_type = ?
                   AND date_start <= ?
                   AND date_end >= ?";

    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param('iss', $parkingTypeId, $arrivalDate, $departureDate);
    $countStmt->execute();
    $countStmt->store_result();
    $countStmt->bind_result($countSlots);
    $countStmt->fetch();

    if ($countSlots < 10) {
        echo 'available';
    } else {
        echo 'unavailable';
    }
}
?>
