<?php
session_start();
include "../config/conn.php";

// Delete product
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    
    // First get image name to delete from server
    $sql = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if ($product) {
        // Delete product from database
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Delete the image file if exists
            if (!empty($product['image'])) {
                $image_path = "../uploads/products/" . $product['image'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $_SESSION['status'] = "Product deleted successfully.";
        } else {
            $_SESSION['status'] = "Error deleting product: " . $stmt->error;
        }
        $stmt->close();
    }
    header("Location: view_products.php");
    exit;
}

// Fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .product-img {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2>Product List</h2>
                <a href="add_product.php" class="btn btn-light">
                    <i class="bi bi-plus-circle"></i> Add New Product
                </a>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['status'])): ?>
                    <div class="alert alert-info" role="alert"><?= $_SESSION['status']; unset($_SESSION['status']); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">No products found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $index => $product): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <?php if (!empty($product['image'])): ?>
                                                <img src="../uploads/<?= $product['image'] ?>" 
                                                     alt="<?= htmlspecialchars($product['title']) ?>" 
                                                     class="product-img rounded">
                                            <?php else: ?>
                                                <span class="text-muted">No image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($product['title']) ?></td>
                                        <td><?= nl2br(htmlspecialchars(substr($product['description'], 0, 50))) ?><?= strlen($product['description']) > 50 ? '...' : '' ?></td>
                                        <td><?= $product['quantity'] ?></td>
                                        <td>$<?= number_format($product['price'], 2) ?></td>
                                        <td><?= date('M j, Y', strtotime($product['created_at'])) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit_product.php?id=<?= $product['id'] ?>" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="view_products.php?delete_id=<?= $product['id'] ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   title="Delete"
                                                   onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>