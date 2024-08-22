<?php
header('Access-Control-Allow-Origin: /');
header('Content-Type: application/json');

require 'public/php/vendor/phpmailer/phpmailer/src/Exception.php';
require 'public/php/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'public/php/vendor/phpmailer/phpmailer/src/SMTP.php';

if(empty($_SERVER['CONTENT_TYPE'])) {
    $type = "application/x-www-form-urlencoded";
    $_SERVER['CONTENT_TYPE'] = $type;
}

$data = json_decode(file_get_contents("php://input"),true);

if(!empty($data['data'])){
    $email = $data['data']['email'];
    $order_number = $data['data']['order_number'];
    $order_amount = $data['data']['order_amount'];

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    //Configure the mail server settings:
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'meancook.dy@gmail.com'; // SMTP username
    $mail->Password = 'ymug qyrr aosl cswk '; // The App Password you generated
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    //Set the sender and recipient email addresses:
    $mail->setFrom('meancook.dy@gmail.com', 'Qryptal'); // Set sender email and name
    $mail->addAddress($email, 'Recipient Name'); // Add a recipient

    //Set the email content
    $mail->Subject = "You order has been placed";
    $mail->Body = "Tank you for yor order";

    //Send the email

    if (!$mail->send()) {
        $response = array('success' => false, 'message' => $mail->ErrorInfo);
    } else {

        $response = array('success' => true, 'message' => 'Email sent successfully.!');

    }
    echo json_encode($response);
}







