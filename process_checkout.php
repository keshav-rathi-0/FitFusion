<?php
// process_checkout.php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    // Validate input fields
    $firstName = htmlspecialchars($data['first_name']);
    $lastName = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $address = htmlspecialchars($data['address']);
    $city = htmlspecialchars($data['city']);
    $state = htmlspecialchars($data['state']);
    $zip = htmlspecialchars($data['zip']);
    $cardNumber = htmlspecialchars($data['card_number']);
    $expiryDate = htmlspecialchars($data['expiry_date']);
    $cvv = htmlspecialchars($data['cvv']);

    // Check if all fields are filled
    if (empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zip) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        die(json_encode(["error" => "All fields are required."]));
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die(json_encode(["error" => "Invalid email format."]));
    }

    // Validate card number (basic check for 16 digits)
    if (!preg_match('/^\d{16}$/', $cardNumber)) {
        die(json_encode(["error" => "Invalid card number. Must be 16 digits."]));
    }

    // Validate expiry date (MM/YY format)
    if (!preg_match('/^\d{2}\/\d{2}$/', $expiryDate)) {
        die(json_encode(["error" => "Invalid expiry date. Use MM/YY format."]));
    }

    // Validate CVV (3 or 4 digits)
    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        die(json_encode(["error" => "Invalid CVV. Must be 3 or 4 digits."]));
    }

    // If all validations pass, process the order
    $response = [
        "success" => true,
        "message" => "Order Placed Successfully!",
        "data" => [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "address" => $address,
            "city" => $city,
            "state" => $state,
            "zip" => $zip,
            "cardNumber" => $cardNumber,
            "expiryDate" => $expiryDate,
            "cvv" => $cvv
        ]
    ];

    // Clear the cart after successful checkout
    $_SESSION['cart'] = [];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode(["error" => "Invalid request method."]);
}
?>