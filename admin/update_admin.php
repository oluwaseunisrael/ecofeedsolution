<?php
ob_start();  // Start output buffering

include('include/header.php');
include "../config/conn.php";

// Get the admin ID from the URL
if (isset($_GET['id'])) {
    $admin_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the admin's data from the database
    $query = "SELECT * FROM admin WHERE id='$admin_id'";
    $queryrun = mysqli_query($conn, $query);

    if (mysqli_num_rows($queryrun) > 0) {
        $admin = mysqli_fetch_array($queryrun);
    } else {
        echo "<h5>No admin found with this ID.</h5>";
        exit();
    }
}

// Handle form submission
if (isset($_POST['update_admin'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $update_query = "UPDATE admin SET name='$name', email='$email', password='$password' WHERE id='$admin_id'";
    $queryrun = mysqli_query($conn, $update_query);

    if ($queryrun) {
        $_SESSION['status'] = "Admin updated successfully!";
        header("Location: admin-table.php"); // Redirect to admin list page after update
        exit(0);
    } else {
        echo "<h5>Failed to update admin details. Please try again.</h5>";
    }
}
?>

<!-- Admin Update Form Design -->
<style>
    .update-form {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        font-weight: bold;
    }
    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn-submit {
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-submit:hover {
        background-color: #45a049;
    }
    .form-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
</style>

<div class="update-form">
     <?php if (isset($_SESSION['status'])): ?>
                <script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Notification',
                    text: '<?= $_SESSION['status'] ?>',
                    confirmButtonColor: '#007bff',
                  });
                </script>
                <?php unset($_SESSION['status']); endif; ?>
    <h2 class="form-title">Update Admin Information</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Admin Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($admin['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Admin Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>" required>
        </div>
         <div class="form-group">
            <label for="email">Admin Password:</label>
            <input type="password" name="password" value="<?= htmlspecialchars($admin['password']); ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="update_admin" class="btn-submit">Update Admin</button>
        </div>
    </form>
</div>


<?php ob_end_flush(); ?>  <!-- End output buffering -->
