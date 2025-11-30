<?php
session_start();
include "../config/conn.php";

if (isset($_POST['admin'])) {
    // Get input values
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    // Validation
    if ($name == '' || $password == '') {
        $_SESSION['status'] = "Fill all required fields";
        header("Location: admin.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email";
        header("Location: admin.php");
        exit();
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: admin.php");
        exit();
    }

    // Check if email or name already exists
    $checkquery = "SELECT * FROM admin WHERE email = '$email' OR name = '$name'";
    $queryrun = mysqli_query($conn, $checkquery);
    
    if (mysqli_num_rows($queryrun) > 0) {
        $_SESSION['status'] = "Email or Name already exists";
        header("Location: admin.php");
        exit();
    } else {
        // Prepare the SQL statement to insert new admin
        $insertquery = "INSERT INTO `admin` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hashpassword')";
        
        // Execute the query
        if (mysqli_query($conn, $insertquery)) {
            $_SESSION['status'] = "Admin registered successfully!";
            header("Location: admin.php");
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($conn);
            header("Location: admin.php");
        }
    }
}

//update admin


?>
