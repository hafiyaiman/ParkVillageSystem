<?php
session_start();

require('../config.php');
require('../functions.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['Name'];
    $updatedEmail = $_POST['email'];
    $updatedPnum = $_POST['Pnum'];
    $updatedPassword = $_POST['password']; 

    // Hash the password
    $hashedPassword = password_hash($updatedPassword, PASSWORD_DEFAULT);

    $updatedAddress = $_POST['Address'];

    $updateCustomerQuery = "UPDATE customer SET Name = ?, Pnum = ?, Address = ? WHERE User_ID = ?";

    $stmtCustomer = mysqli_prepare($conn, $updateCustomerQuery);
    mysqli_stmt_bind_param($stmtCustomer, 'sssi', $updatedName, $updatedPnum, $updatedAddress, $user_id);

    if (mysqli_stmt_execute($stmtCustomer)) {
        $responseCustomer = array('status' => 'success', 'message' => 'Customer data updated successfully!');
    } else {
        $responseCustomer = array('status' => 'error', 'message' => 'Error updating customer data: ' . mysqli_stmt_error($stmtCustomer));
    }

    mysqli_stmt_close($stmtCustomer);

    $updateUserQuery = "UPDATE users SET email = ?, password = ? WHERE User_ID = ?";

    $stmtUser = mysqli_prepare($conn, $updateUserQuery);
    mysqli_stmt_bind_param($stmtUser, 'ssi', $updatedEmail, $hashedPassword, $user_id);

    if (mysqli_stmt_execute($stmtUser)) {
        $responseUser = array('status' => 'success', 'message' => 'User data updated successfully!');
    } else {
        $responseUser = array('status' => 'error', 'message' => 'Error updating user data: ' . mysqli_stmt_error($stmtUser));
    }

    mysqli_stmt_close($stmtUser);

    $response = array_merge($responseCustomer, $responseUser);

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
