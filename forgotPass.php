<!-- forgotPass.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Forgot Password</title>
</head>

<body>
    <div class="container" id="container" style="height: 550px; width: 900px;">

        <form action="sendResetLink.php" method="POST">
            <h2 style="width:100%; text-align: center; margin-bottom: 30px;">Forgot Password</h2>
            <label for="email">Enter your email:</label>
            <input style="width:50%" type="email" name="email" required>
            <button class="hidden" type="submit">Send Reset Link</button>
        </form>
    </div>

</body>

</html>