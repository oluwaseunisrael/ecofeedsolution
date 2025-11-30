<?php

include('include/header.php');
include "../config/conn.php";
$query = "SELECT * FROM admin";
$queryrun = mysqli_query($conn, $query);
?>

<!-- Table Design -->
<style>
    .main{
          margin: 20px 6%;
    }
    table {
        width: 100%;
        border-collapse: collapse;
      
        font-size: 18px;
        text-align: left;

    }
    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .action-btns {
        display: flex;
        gap: 10px;
    }
    .btn {
        padding: 5px 10px;
        border: none;
        color: white;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-update {
        background-color: #4CAF50;
    }
    .btn-delete {
        background-color: #f44336;
    }
    .btn-add {
        background-color: #008CBA;
        margin-bottom: 20px;
        display: inline-block;
        padding: 10px 20px;
        color: white;
        text-decoration: none;
    }
</style>

<!-- Add Admin Button -->
<a href="admin.php" class="btn-add">Add Admin</a>

<?php
if (mysqli_num_rows($queryrun) > 0) {
?>
<div class="main">
    <table>
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
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($queryrun as $admin) {
            ?>
            <tr>
                <td><?= htmlspecialchars($admin['name']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td>
                    <div class="action-btns">
                        <!-- Update Button -->
                        <a href="update_admin.php?id=<?= $admin['id'] ?>" class="btn btn-update">Update</a>

                        <!-- Delete Button -->
                        <a href="delete_admin.php?id=<?= $admin['id'] ?>" class="btn btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo "<h5>NO ADMIN IN DATABASE</h5>";
}
