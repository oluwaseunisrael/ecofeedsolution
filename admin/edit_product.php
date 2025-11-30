<?php
session_start();
include "../config/conn.php";

if (!isset($_GET['id'])) {
    header("Location: view_products.php");
    exit;
}

$id = (int)$_GET['id'];

// Fetch product data
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    $_SESSION['status'] = "Product not found.";
    header("Location: view_products.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $quantity = (int)$_POST['quantity'];
    $price = !empty($_POST['price']) ? floatval($_POST['price']) : NULL;
    $price_negotiable = isset($_POST['price_negotiable']) ? 1 : 0;

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);

    // Handle image update
    $image = $product['image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadedImage = $_FILES['image'];
        $imageName = basename($uploadedImage['name']);
        $imageTmpName = $uploadedImage['tmp_name'];
        $imageSize = $uploadedImage['size'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageType, $allowedTypes)) {
            $_SESSION['status'] = "Error: Only image files are allowed (JPG, JPEG, PNG, GIF, WEBP).";
            header("Location: edit_product.php?id=$id");
            exit;
        }

        if ($imageSize > 5 * 1024 * 1024) {
            $_SESSION['status'] = "Error: File size exceeds 5MB.";
            header("Location: edit_product.php?id=$id");
            exit;
        }

        $uploadDir = '../uploads/';
        $uniqueImageName = uniqid('product_', true) . '.' . $imageType;
        $uploadPath = $uploadDir . $uniqueImageName;

        if (move_uploaded_file($imageTmpName, $uploadPath)) {
            // Delete old image if it exists
            if (!empty($product['image'])) {
                $oldImagePath = $uploadDir . $product['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $uniqueImageName;
        } else {
            $_SESSION['status'] = "Error: There was an issue uploading your file.";
            header("Location: edit_product.php?id=$id");
            exit;
        }
    }

    // Update product
    $sql = "UPDATE products SET title = ?, description = ?, quantity = ?, price = ?, price_negotiable = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiidsi", $title, $description, $quantity, $price, $price_negotiable, $image, $id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Product updated successfully.";
        header("Location: view_products.php");
        exit;
    } else {
        $_SESSION['status'] = "Error: " . $stmt->error;
        header("Location: edit_product.php?id=$id");
        exit;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .price-container {
            position: relative;
        }
        .negotiable-checkbox {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2>Edit Product</h2>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['status'])): ?>
                    <div class="alert alert-info" role="alert"><?= $_SESSION['status']; unset($_SESSION['status']); ?></div>
                <?php endif; ?>

                <form action="edit_product.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title:</label>
                        <input type="text" id="title" name="title" class="form-control" 
                               value="<?= htmlspecialchars($product['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" 
                                   min="0" value="<?= $product['quantity'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price:</label>
                            <div class="price-container">
                                <input type="number" id="price" name="price" class="form-control" 
                                       min="0" step="0.01" value="<?= $product['price'] ?? '' ?>">
                                <div class="form-check negotiable-checkbox">
                                    <input class="form-check-input" type="checkbox" id="price_negotiable" name="price_negotiable" 
                                           <?= $product['price_negotiable'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="price_negotiable">Negotiable</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image:</label>
                        <?php if (!empty($product['image'])): ?>
                            <div class="mb-2">
                                <img src="../uploads/products/<?= $product['image'] ?>" 
                                     alt="<?= htmlspecialchars($product['title']) ?>" 
                                     style="max-width: 150px; max-height: 150px;" class="img-thumbnail">
                                <div class="form-text">Current image</div>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <div class="form-text">Leave blank to keep current image. Max size: 5MB (JPG, PNG, GIF, WEBP)</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" name="update_product">
                            <i class="bi bi-save"></i> Update Product
                        </button>
                        <a href="view_products.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle price field based on negotiable checkbox
        document.getElementById('price_negotiable').addEventListener('change', function() {
            const priceInput = document.getElementById('price');
            if (this.checked) {
                priceInput.required = false;
                priceInput.placeholder = "Leave empty for negotiable";
            } else {
                priceInput.required = true;
                priceInput.placeholder = "";
            }
        });
        
        // Initialize based on current state
        if (document.getElementById('price_negotiable').checked) {
            document.getElementById('price').required = false;
            document.getElementById('price').placeholder = "Leave empty for negotiable";
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>