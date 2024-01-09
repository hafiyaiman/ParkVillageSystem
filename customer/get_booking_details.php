<?php
// Assuming you have a database connection established
require('../config.php');
require('../functions.php');

$response = array(); // Initialize the response array

// Check if Book_ID is set in the POST request
if(isset($_POST['bookId'])) {
    $bookId = $_POST['bookId'];

    // Fetch specific columns from the database using MySQLi
    $query = "
    SELECT 
        b.Book_ID,
        b.Cust_ID,
        b.Vehicle_ID,
        b.Payment_ID,
        b.Date_IN,
        b.Date_OUT,
        b.KLIA,
        b.Depart_no,
        b.Arrive_no,
        b.duration,
        b.parkType,
        v.Plate_Number,
        b.status_booking,
        c.Name AS customer_name,
        c.Pnum AS customer_phone,
        c.Address AS customer_address,
        v.Model AS vehicle_model,
        v.Color AS vehicle_color,
        v.Plate_Number AS vehicle_plate_number,
        p.Amount AS payment_amount,
        p.Transaction_ID AS payment_transaction_id,
        p.Payment_Method AS payment_method,
        p.payment_status
    FROM booking b
    INNER JOIN customer c ON b.Cust_ID = c.Cust_ID
    INNER JOIN vehicle v ON b.Cust_ID = v.Cust_ID
    INNER JOIN payment p ON b.Cust_ID = p.Cust_ID
    WHERE b.Book_ID = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('i', $bookId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the data as an associative array
            $bookingDetails = $result->fetch_assoc();

            // Check and swap Date_IN and Date_OUT if necessary
            if (strtotime($bookingDetails['Date_IN']) > strtotime($bookingDetails['Date_OUT'])) {
                $tempDate = $bookingDetails['Date_IN'];
                $bookingDetails['Date_IN'] = $bookingDetails['Date_OUT'];
                $bookingDetails['Date_OUT'] = $tempDate;
            }

            // Construct the response array
            $response['status'] = 'success';
            $response['data'] = $bookingDetails;
        } else {
            // No data found for the specified Book_ID
            $response['status'] = 'error';
            $response['message'] = 'No data found for the specified Book_ID';
        }

        $stmt->close();
    } else {
        // Failed to prepare the SQL statement
        $response['status'] = 'error';
        $response['message'] = 'Failed to prepare the SQL statement';
    }
} else {
    // Handle the case where Book_ID is not set in the POST request
    $response['status'] = 'error';
    $response['message'] = 'Book_ID is not set';
}

// Return the response as JSON
header("Content-Type: application/json");
echo json_encode($response);
?>
