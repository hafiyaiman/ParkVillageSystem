<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

// Include PHPMailer autoloader
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'home.php';

function sendEmail($recipient, $subject, $body)
{
    $mail = new PHPMailer(true);

    // Uncomment the line below for debugging
    // $mail->SMTPDebug = PHPMailer::DEBUG_SERVER;

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Specify main and backup SMTP servers
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // SMTP username and password (consider using environment variables)
    $mail->Username = 'haze88125@gmail.com'; // Replace with your SMTP username
    $mail->Password = 'rubrpysmxsfgtepm'; // Replace with your SMTP password

    // Enable TLS encryption, `ssl` also accepted
    $mail->SMTPSecure = 'tls';

    // TCP port to connect to b 
    $mail->Port = 587;

    // Set sender and recipient
    $mail->setFrom('haze88125@gmail.com', 'Haze lane'); // Replace with your email and name
    $mail->addAddress($recipient);

    $mail->isHtml(true);

    // Set email subject and body
    $mail->Subject = $subject;
    $mail->Body    = $body;

    // Additional configurations (optional)
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Check if the email was sent successfully
    if ($mail->send()) {
        return true; // Email sent successfully
    } else {
        return false; // Email not sent
    }
}

try {
    // Initialize CURL to get PayPal access token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_USERPWD, 'AWr5zm3H33JG36fzyM_016_aGGbXO0ivZKnk9Q7gp1OFfoZjI7gjnD21AjuFo--BhkI1jfPveiXSB24s:ELAVnkaQAFSh2ih6XQV-AzSmUkyxE1GaN-ovScU7appV0b5qzlun-a3hj14fZ8KwplJ4u0X6yndQdfMA');
    $headers = ['Accept: application/json', 'Accept-Language: en_US', 'Content-Type: application/x-www-form-urlencoded'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        throw new Exception('Error getting PayPal access token: ' . curl_error($ch));
    }

    curl_close($ch);

    $result = json_decode($result);

    // Get the access token
    $access_token = $result->access_token;

    // Extract payment ID from the client-side orderID
    $payment_token_parts = explode("-", $_POST["orderID"]);
    $payment_id = (count($payment_token_parts) > 1) ? $payment_token_parts[1] : "";

    // Initialize another CURL to verify the order
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders/' . $payment_id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    $headers = ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($curl);

    if (curl_errno($curl)) {
        throw new Exception('Error verifying PayPal payment: ' . curl_error($curl));
    }

    curl_close($curl);

    // Decode the response JSON
    $result = json_decode($result);

     // Check if the payment is completed
    if (isset($result->status) && $result->status == "COMPLETED") {
        // Extract relevant details from the PayPal API response
        $paymentID = $result->id;
        $payerEmail = isset($result->payer->email_address) ? $result->payer->email_address : $userEmail;
        $amount = $result->purchase_units[0]->amount->value;
        $currency = $result->purchase_units[0]->amount->currency_code;

        // Retrieve customer information from the database based on the logged-in user
        $customerDetails = getCustomerDetails($conn, $user_id);
        $customerName = $customerDetails['Name'];
        $customerPnum = $customerDetails['Pnum'];

        // Construct email body with payment details and customer information
        $emailBody = "Hello $customerName,<br><br>";
        $emailBody .= "Thank you for your payment!<br><br>";
        $emailBody .= "Payment Details:<br>";
        $emailBody .= "Payment ID: $paymentID<br>";
        $emailBody .= "Payer Email: $payerEmail<br>";
        $emailBody .= "Amount: $amount $currency<br><br>";
        $emailBody .= "Customer Information:<br>";
        $emailBody .= "Name: $customerName<br>";
        $emailBody .= "Phone Number: $customerPnum<br><br>";
        // Add more details as needed

        // Display "Payment Success"
        print "Payment Success";

        // Send an email with all details
        sendEmail("haze88125@gmail.com", "Payment Completed", $emailBody);
    } else {
        // The payment is not completed or has an unexpected status
        echo json_encode([
            "status" => "error",
            "message" => "Payment not verified or completed.",
            "result" => $result
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

exit();
?>
