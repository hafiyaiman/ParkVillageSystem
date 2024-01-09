<?php
session_start();

require('config.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Attempt to log in
    $user = loginUser($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['notification'] = "Login successful. Welcome, " . $user['email'] . "!";

        if ($user['role'] == 'admin') {
            header("Location: admin/admin_dashboard.php");
        } else {
            header("Location: customer/home.php");
        }
        exit();
    } else {
        $_SESSION['notification'] = "Invalid email or password. Please try again.";
    }
}

// Display notification if set
$notification = isset($_SESSION['notification']) ? $_SESSION['notification'] : "";
unset($_SESSION['notification']);  // Clear the session variable

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="icon" href="img\dparkvillage.ico" type="image/x-icon">
    <title>Park Village Booking System</title>
    <style>  
    </style>
</head>

<body>

    <div class="container" id="container" style="height: 550px; width: 900px;">
        <div class="form-container sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <br>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <button type="submit">Sign In</button>
                <p>Don't have an account? <a href="register.php" id="registerLink" style="color: #0000FF;" >Register here</a>.</p>
                        <!-- Display notification -->
                        <?php if (!empty($notification)): ?>
    <div id="notification" class="notification">
        <?php echo $notification; ?>
    </div>
<?php endif; ?>

            </form>

        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <!-- <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button> -->
                </div>
            </div>
        </div>
    </div>

    <script>
//         const container = document.getElementById('container');
// const registerBtn = document.getElementById('register');
// const loginBtn = document.getElementById('login');

// registerBtn.addEventListener('click', () => {
//     container.classList.add("active");
// });

// loginBtn.addEventListener('click', () => {
//     container.classList.remove("active");
// });

setTimeout(function () {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.style.display = 'none';
                }
            }, 2000);
    </script>
</body>

</html>
