<?php
session_start();
require('../config.php');
require('../functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the POST request
    $bookID = $_POST['bookID'];

    // Perform the delete operation in the database
    $deleteSql = "DELETE FROM booking WHERE Book_ID = '$bookID'";
    if ($conn->query($deleteSql) === TRUE) {
        // Return a success message (you can customize the response as needed)
        echo "Booking deleted successfully";
        exit();
    } else {
        // Return an error message if the deletion fails
        echo "Error deleting booking: " . $conn->error;
        exit();
    }
} else {
    // Return an error message if accessed without POST data
    echo "Invalid request";
    exit();
}
?>
