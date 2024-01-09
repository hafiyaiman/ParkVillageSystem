<?php

session_start();

require('config.php');
require('functions.php');

// Verify the token from the URL
$token = $_GET['token'];

// Fetch user based on the token
$getUserQuery = "SELECT * FROM users WHERE reset_token = ?";
$stmt = $conn->prepare($getUserQuery);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Invalid or expired token
    echo "Invalid or expired token.";
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['newPassword'];
    // Attempt to log in
    resetPass($token, $newPassword);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Password Reset</title>
</head>

<body>
    <div class="container" id="container" style="height: 550px; width: 900px;">
        <form action="" method="post">
            <h2 style="width:100%; text-align: center; margin-bottom: 30px;">Reset Your Password</h2>
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="newPassword">New Password:</label>
            <input style="width:50%" type="password" name="newPassword" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>