<?php
// Database connection details
$host = "localhost";  // Host address
$username = "ecofpzeg_admin2";  // Database username
$password = "Oluwaseun123";  // Database password
$database = "ecofpzeg_ecofeedsolution";  // Database name

// Create a connection to the MySQL database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    // If the connection failed, display an error message
    echo "Connection not successful: " . mysqli_connect_error();
} 
?>
