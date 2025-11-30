

// view-products.php
<?php
session_start();
include "../config/conn.php";

$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product List</h1>
    <?php if (isset($_SESSION['status'])): ?>
        <div class="alert alert-info"><?php echo $_SESSION['status']; unset($_SESSION['status']); ?></div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (₦)</th>
                <th>Quantity</th>
                <th>Sale Price (₦)</th>
                <th>Variant</th>
                <th>Sold</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['sale_price']; ?></td>
                    <td><?php echo $row['variant']; ?></td>
                    <td><?php echo $row['sold'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <?php $images = explode(',', $row['images']); ?>
                        <?php foreach ($images as $img): ?>
                            <img src="../uploads/<?php echo $img; ?>" width="50">
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <a href="edit-product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete-product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

// edit-product.php
<?php
session_start();
include "../config/conn.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM products WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $sale_price = mysqli_real_escape_string($conn, $_POST['sale_price']);
    $variant = mysqli_real_escape_string($conn, $_POST['variant']);
    $sold = isset($_POST['sold']) ? 1 : 0;
    
    $updateQuery = "UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity', sale_price='$sale_price', variant='$variant', sold='$sold' WHERE id='$id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['status'] = "Product updated successfully.";
        header('Location: view-products.php');
        exit();
    } else {
        $_SESSION['status'] = "Update failed.";
    }
}
?>
