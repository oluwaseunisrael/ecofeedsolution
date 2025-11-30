<?php
session_start();

include '../config/conn.php';

$id = $_GET["id"];
$sql = "DELETE FROM categories WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    $_SESSION["status"] = "Category deleted successfully";
    header("Location: view_categories.php");
    exit();
} else {
    $_SESSION["status"] = "Error: " . mysqli_error($conn);
    header("Location: view_categories.php");
    exit();
}
?>
