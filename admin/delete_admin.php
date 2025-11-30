<?php 
session_start();
ob_start(); 
include "../config/conn.php";
include('includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM admin WHERE id = '$id'";
    $queryrun = mysqli_query($conn, $query);

    if ($queryrun) {
        $_SESSION['status'] = "Profile successfully Deleted from Database";
    } else {
        $_SESSION['status'] = "Not successfully Deleted";
    }

    header('Location:admin-table.php');
    exit();
}

include('includes/footer.php');

