<?php
header('Content-Type: application/json');
session_start();
include "config/conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email is required'
        ]);
        exit;
    }

    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Please enter a valid email address'
        ]);
        exit;
    }

    // Check if email already exists
    $check_query = "SELECT id FROM newsletter_subscribers WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'This email is already subscribed'
        ]);
        exit;
    }

    // Insert new subscriber
    $insert_query = "INSERT INTO newsletter_subscribers (email, ip_address) VALUES ('$email', '$ip_address')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Thank you for subscribing!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Subscription failed: ' . mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

mysqli_close($conn);
?>