<?php
session_start();
require('config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $registered = registerUser($name, $email, $password, $address, $phone);

    if ($registered === true) {
        $_SESSION['notification'] = "Registration successful. You can now log in.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['notification'] = "Registration failed. " . $registered;
        header("Location: register.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Park Village Booking System</title>
</head>

<body>

    <div class="container" id="container" style="height: 550px; width: 900px;">
        <div class="form-container sign-in">
            <form method="POST" action="register.php">
                <br><br />
                <h1>Create Account</h1>
                <br><br />
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="number" name="phone" placeholder="Phone" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="index.php" id="loginLink" style="color: #0000FF;">Login here</a>.
                </p>
                <?php
                if (isset($_SESSION['notification'])) {
                    echo '<div class="notification">' . $_SESSION['notification'] . '</div>';
                    unset($_SESSION['notification']);
                }
                ?>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">

                </div>
                <div class="toggle-panel toggle-right">

                </div>
            </div>
        </div>
    </div>

</body>

</html>