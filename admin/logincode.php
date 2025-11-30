<?php
session_start();
include "../config/conn.php";
include "function.php"; // Assuming this file contains the logAdminActivity function

if (isset($_POST['login'])) {
    // Escaping special characters to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username exists
    $checkVerify = "SELECT * FROM admin WHERE name = '$username' LIMIT 1";
    $queryrun = mysqli_query($conn, $checkVerify);

    if (mysqli_num_rows($queryrun) > 0) {
        $row = mysqli_fetch_assoc($queryrun);
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['loginInUser'] = true; 
            $_SESSION['admin'] = [
                'id' => $row['id'], 
                'name' => $row['name'],
                'email' => $row['email']
            ];

            // Redirect to admin dashboard after successful login
            header("Location: index.php");
            exit();
        } else {
            // Password incorrect
            $_SESSION['status'] = "Invalid password";
            header('Location: login.php');
            exit();
        }
    } else {
        // Username not found
        $_SESSION['status'] = "Username not found";
        header('Location: login.php');
        exit();
    }
}
?>
