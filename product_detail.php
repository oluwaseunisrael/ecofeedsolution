<?php 
include "include/headers.php";
include "config/conn.php";

// Check if product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: products.php");
    exit;
}

$productId = (int)$_GET['id'];

// Fetch product data
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: products.php");
    exit;
}

// Fetch related products (excluding current product)
$relatedQuery = "SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT 4";
$relatedStmt = $conn->prepare($relatedQuery);
$relatedStmt->bind_param("i", $productId);
$relatedStmt->execute();
$relatedResult = $relatedStmt->get_result();
$relatedProducts = $relatedResult->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($product['title']) ?> - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <style>
  
    </style>
</head>
<body>
    <!-- Breadcrumb Navigation -->
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a> &gt; 
            <a href="products.php">Products</a> &gt; 
            <span><?= htmlspecialchars($product['title']) ?></span>
        </div>
    </div>
    
    <!-- Product Section -->
    <div class="container">
        <div class="product-section">
            <div class="product-gallery">
                <div class="main-image">
                    <?php if (!empty($product['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($product['image']) ?>" 
                             alt="<?= htmlspecialchars($product['title']) ?>">
                    <?php else: ?>
                        <img src="img/product-placeholder.jpg" alt="Product Image">
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="product-info">
            
                
                <h1 class="product-title"><?= htmlspecialchars($product['title']) ?></h1>
                
                <div class="product-price">
                    <?php if ($product['price'] == 0 || $product['price'] == NULL): ?>
                        <span class="price-negotiable">Contact for price</span>
                    <?php else: ?>
                        $<?= number_format($product['price'], 2) ?>
                    <?php endif; ?>
                </div>
                
                <div class="product-description">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </div>
                
                <div class="product-meta">
                    <div class="meta-item">
                    
                    </div>
                    <?php if (!empty($product['specs'])): ?>
                        <div class="meta-item">
                            <span class="meta-label">Specifications:</span>
                            <span><?= htmlspecialchars($product['specs']) ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="meta-item">
                        <span class="meta-label">SKU:</span>
                        <span>PROD-<?= str_pad($product['id'], 4, '0', STR_PAD_LEFT) ?></span>
                    </div>
                </div>
                
                <div class="btn-group">
                    <a href="order.php?product_id=<?= $product['id'] ?>" class="btn btn-primary">Order Now</a>
                    <a href="contact.php" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <?php 
    include "include/footer.php";
    mysqli_close($conn);
    ?>
</body>
</html>