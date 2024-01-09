<?php
require('config.php');
function loginUser($email, $password)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        $storedPassword = $user["password"];

        //echo "Stored Password: $storedPassword<br>";
        //echo "Entered Password: $password<br>";

        if (password_verify($password, $storedPassword)) {
            return $user;
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}

function registerUser($name, $email, $password, $address, $phone)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $phone = mysqli_real_escape_string($conn, $phone);

    $checkQuery = "SELECT * FROM users WHERE email = ?";

    try {
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Email already exists. Please use a different email address.";
            return $errorMessage;
        }

        $insertUserQuery = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'customer')";
        $stmt = $conn->prepare($insertUserQuery);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        $insertUserResult = $stmt->execute();

        if (!$insertUserResult) {
            $errorMessage = "User registration failed. Please try again.";
            return $errorMessage;
        }

        $user_id = $stmt->insert_id;

        $insertCustomerQuery = "INSERT INTO customer (Name, Pnum, User_ID, Address) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertCustomerQuery);
        $stmt->bind_param("siss", $name, $phone, $user_id, $address);
        $insertCustomerResult = $stmt->execute();

        if (!$insertCustomerResult) {
            $errorMessage = "Customer registration failed. Please try again.";
            return $errorMessage;
        }

        return true; // Registration successful
    } catch (Exception $e) {
        $errorMessage = "An error occurred during registration. Please try again.";
        return $errorMessage;
    } finally {
        $stmt->close();
    }
}


function resetPass($token, $newPassword)
{
    try {
        global $conn;

        // Fetch user based on the token
        $getUserQuery = "SELECT * FROM users WHERE reset_token = ?";
        $stmt = $conn->prepare($getUserQuery);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Invalid or expired token
            echo "Invalid or expired token.";
            exit(0);
        }

        // Valid token, update the password
        $user = $result->fetch_assoc();
        $stmt->close(); // Close the first statement

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE users SET password = ?, reset_token = NULL WHERE User_ID = ?";
        $stmt = $conn->prepare($updatePasswordQuery);
        $stmt->bind_param("si", $hashedPassword, $user['User_ID']); // Corrected the key
        $stmt->execute();
        $stmt->close();

        // Additional code if needed

        echo "Password updated successfully. You can now <a href='login.php'>log in</a>.";
    } catch (Exception $e) {
        echo "Error updating password: " . $e->getMessage();
    }

}


function generateFaviconLink($path = '../img/dparkvillage.ico')
{
    echo '<link rel="icon" href="' . $path . '" type="image/x-icon">';
}

function generateSidebar()
{
    echo '
    <div class="sidebar px-4 py-4 py-md-5 me-0">
    <div class="d-flex flex-column h-100">
        <a href="admin_dashboard.php" class="mb-0 brand-icon">
            <span class="logo-icon">
           
                  
                <img src="../img/dparkvillage.ico" alt="Logo" width="75" height="70">
             
            </span>
            <span class="logo-text">D Park Village</span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
          
            <li class="collapsed">
            <a class="m-link" href="admin_dashboard.php"><i
                    class="icofont-home fs-5"></i> <span>Dashboard</span></a>
            <!-- Menu: Sub menu ul -->
        
        </li>

            <li class="collapsed">
            <a class="m-link" href="manage_booking.php"><i
                    class="icofont-file-alt"></i> <span>Manage Booking</span></a>
            <!-- Menu: Sub menu ul -->
        
        </li>
        <li class="collapsed">
        <a class="m-link" href="report.php"><i
                class="icofont-notepad"></i> <span>Report</span></a>
        <!-- Menu: Sub menu ul -->
        
</li>
      
        <!-- Theme: Switch Theme -->
        <ul class="list-unstyled mb-0 " style="position: absolute; bottom: 100px;">
        <li class="d-flex align-items-center justify-content-center">
            <div class="form-check form-switch theme-switch">
                <input class="form-check-input" type="checkbox" id="theme-switch">
                <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
            </div>
        </li>
        <li class="d-flex align-items-center justify-content-center">
            
        </li>
    </ul>

    <!-- Menu: menu collapse btn -->
    <button type="button" class="btn btn-link sidebar-mini-btn text-light" style="position: absolute; bottom: 40px;" >
        <span class="ms-2"><i class="icofont-bubble-right"></i></span>
    </button>
</div>
</div>';
}

function getUserDetails($conn, $user_id)
{
    $userDetails = array();

    // Fetch user details
    $userDetailsSql = "SELECT * FROM users WHERE User_ID = '$user_id'";
    $userDetailsResult = $conn->query($userDetailsSql);

    if ($userDetailsResult->num_rows > 0) {
        $userDetails = $userDetailsResult->fetch_assoc();
    } else {
        echo "Error: User details not found!";
    }

    return $userDetails;
}

function getCustomerDetails($conn, $user_id)
{
    $customerDetails = array();

    // Fetch customer details
    $customerDetailsSql = "SELECT * FROM customer WHERE User_ID = '$user_id'";
    $customerDetailsResult = $conn->query($customerDetailsSql);

    if ($customerDetailsResult->num_rows > 0) {
        $customerDetails = $customerDetailsResult->fetch_assoc();
    } else {
        echo "Error: Customer details not found!";
    }

    return $customerDetails;
}

function getParkingSlotData($conn)
{
    $parkingSlotData = array();

    // Select parking slots for "no roof" (park_id = 1)
    $parkingSlotSqlNoRoof = "SELECT numpark_available FROM parking WHERE park_id = 1";
    $parkingSlotResultNoRoof = $conn->query($parkingSlotSqlNoRoof);

    if ($parkingSlotResultNoRoof) {
        $parkingSlotData['noRoof'] = $parkingSlotResultNoRoof->fetch_assoc();
    } else {
        echo "Error: " . $parkingSlotSqlNoRoof . "<br>" . $conn->error;
    }

    // Select parking slots for "roof" (park_id = 2)
    $parkingSlotSqlRoof = "SELECT numpark_available FROM parking WHERE park_id = 2";
    $parkingSlotResultRoof = $conn->query($parkingSlotSqlRoof);

    if ($parkingSlotResultRoof) {
        $parkingSlotData['roof'] = $parkingSlotResultRoof->fetch_assoc();
    } else {
        echo "Error: " . $parkingSlotSqlRoof . "<br>" . $conn->error;
    }

    return $parkingSlotData;
}

function getBookingDataByUserId($conn, $user_id)
{
    $bookingData = array();

    $sql = "SELECT
    booking.Book_ID,
    booking.Book_Reff_num,
    booking.Cust_ID AS booking_Cust_ID,
    booking.Vehicle_ID AS booking_Vehicle_ID,
    booking.Payment_ID AS booking_Payment_ID,
    booking.Date_IN,
    booking.Date_OUT,
    booking.KLIA,
    booking.Depart_no,
    booking.Arrive_no,
    booking.status_booking,
    booking.parkType,
    booking.duration,
    payment.Amount AS payment_Amount,
    payment.Transaction_ID AS payment_Transaction_ID,
    payment.Payment_Method AS payment_Payment_Method,
    payment.payment_status AS payment_payment_status,
    vehicle.Vehicle_ID AS vehicle_Vehicle_ID,
    vehicle.Model AS vehicle_Model,
    vehicle.Color AS vehicle_Color,
    vehicle.Plate_Number AS vehicle_Plate_Number,
    customer.Cust_ID AS customer_Cust_ID,
    customer.Name AS customer_Name,
    customer.Pnum AS customer_Pnum,
    customer.User_ID AS customer_User_ID,
    customer.Address AS customer_Address
FROM customer
INNER JOIN vehicle ON customer.Cust_ID = vehicle.Cust_ID
INNER JOIN booking ON customer.Cust_ID = booking.Cust_ID
INNER JOIN payment ON customer.Cust_ID = payment.Cust_ID
WHERE customer.User_ID = ?

";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $bookingData[] = $row;
    }

    $stmt->close();

    return $bookingData;
}



function getBookingDetailsById($conn, $bookId)
{
    $bookingDetails = array();

    $sql = "SELECT * FROM customer
            INNER JOIN vehicle ON customer.Cust_ID = vehicle.Cust_ID
            INNER JOIN booking ON customer.Cust_ID = booking.Cust_ID
            INNER JOIN payment ON customer.Cust_ID = payment.Cust_ID
            WHERE booking.Book_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookingDetails = $result->fetch_assoc();
    }

    $stmt->close();

    return $bookingDetails;
}

?>