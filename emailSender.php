<?php
header('Access-Control-Allow-Origin: /');
header('Content-Type: application/json');

if(empty($_SERVER['CONTENT_TYPE'])) {
    $type = "application/x-www-form-urlencoded";
    $_SERVER['CONTENT_TYPE'] = $type;
}

$data = json_decode(file_get_contents("php://input"),true);

if(!empty($data['data'])){
    $email = $data['data']['email'];
    $order_number = $data['data']['order_number'];
    $order_amount = $data['data']['order_amount'];

    $subject = 'Order information';

    $message = "Your order .${$order_number} for .${$order_amount} amount is complete.";

    $headers = 'From: shop-nnn@gmail.com' . "\r\n" .

        'Reply-To: shop-nnn@gmail.com' . "\r\n" .

        'MIME-Version: 1.0' . "\r\n" .

        'Content-Type: text/plain; charset=UTF-8';

    if (mail($email, $subject, $message, $headers)) {
        $response = array('success' => true, 'message' => 'Email sent successfully.!');


    } else {
        $response = array('success' => false, 'message' => 'Error sending email.');

    }
    echo json_encode($response);
}







