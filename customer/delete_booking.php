<?php
require('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized and validated your inputs before deleting from the database
    $bookId = $_POST['bookId'];

    try {
        $conn->autocommit(FALSE); // Start transaction

        // Delete from booking table
        $queryDeleteBooking = "DELETE FROM booking WHERE Book_ID = ?";
        $stmtDeleteBooking = $conn->prepare($queryDeleteBooking);
        $stmtDeleteBooking->bind_param("i", $bookId);
        $stmtDeleteBooking->execute();
        $stmtDeleteBooking->close();

        // Delete from customer table
        $queryDeleteCustomer = "DELETE FROM customer WHERE Book_ID = ?";
        $stmtDeleteCustomer = $conn->prepare($queryDeleteCustomer);
        $stmtDeleteCustomer->bind_param("i", $bookId);
        $stmtDeleteCustomer->execute();
        $stmtDeleteCustomer->close();

        // Delete from vehicle table
        $queryDeleteVehicle = "DELETE FROM vehicle WHERE Vehicle_ID IN (SELECT Vehicle_ID FROM booking WHERE Book_ID = ?)";
        $stmtDeleteVehicle = $conn->prepare($queryDeleteVehicle);
        $stmtDeleteVehicle->bind_param("i", $bookId);
        $stmtDeleteVehicle->execute();
        $stmtDeleteVehicle->close();

        // Delete from payment table
        $queryDeletePayment = "DELETE FROM payment WHERE Payment_ID IN (SELECT Payment_ID FROM booking WHERE Book_ID = ?)";
        $stmtDeletePayment = $conn->prepare($queryDeletePayment);
        $stmtDeletePayment->bind_param("i", $bookId);
        $stmtDeletePayment->execute();
        $stmtDeletePayment->close();

        $conn->commit(); // Commit the transaction

        // Delete successful
        $response = ['status' => 'success', 'message' => 'Booking and associated records deleted successfully'];

    } catch (Exception $e) {
        $conn->rollback(); // Rollback if any exception occurred
        $response = ['status' => 'error', 'message' => 'Error deleting records: ' . $e->getMessage()];
    } finally {
        $conn->autocommit(TRUE); // Restore autocommit mode
    }

    $conn->close();

    echo json_encode($response);
} else {
    // If not a POST request, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
