<?php 
include "include/headers.php";
include "config/conn.php";

// Pagination setup
$itemsPerPage = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Get total number of products
$totalQuery = "SELECT COUNT(*) as total FROM products";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $itemsPerPage);

// Fetch products for current page
$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Products - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <style>
        .products-header {
        /* Set the background image */
        background-image: url('img/header-produits.jpg');
        
        /* Ensure the background covers the entire section */
        background-size: cover;
      
        
        /* Add some padding to make the text look better */
        padding: 80px 20px;
        
        /* Optional: Add a semi-transparent overlay to make text more readable */
        position: relative;
    }
    
    .products-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3); /* Adjust opacity as needed */
        z-index: 1;
    }
    
    .products-header h1 {
        position: relative;
        z-index: 2;
        color: white; /* Or any color that contrasts with your image */
        text-align: center;
        
    }
    </style>
</head>
<body>
    <!-- Products Header -->
  <section class="products-header">
   
</section>

    <!-- Products Grid -->
    <div class="products-container">
        <div class="products-grid">
            <?php if (empty($products)): ?>
                <div class="no-products" style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <h3>No products found</h3>
                    <p>Check back later for our latest aquaculture products</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php if (!empty($product['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($product['image']) ?>" 
                                     alt="<?= htmlspecialchars($product['title']) ?>">
                            <?php else: ?>
                                <img src="img/product-placeholder.jpg" alt="Product Image">
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <span class="product-category"><?= htmlspecialchars($product['category'] ?? 'Product') ?></span>
                            <h3 class="product-title"><?= htmlspecialchars($product['title']) ?></h3>
                            <p class="product-description">
                                <?= nl2br(htmlspecialchars(substr($product['description'], 0, 100))) ?>
                                <?= strlen($product['description']) > 100 ? '...' : '' ?>
                            </p>
                            <div class="product-price">
                                <?php if ($product['price'] == 0 || $product['price'] == NULL): ?>
                                    <span class="price-negotiable">Contact for price</span>
                                <?php else: ?>
                                    $<?= number_format($product['price'], 2) ?>
                                <?php endif; ?>
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-secondary" 
                                        onclick="window.location.href='product_detail.php?id=<?= $product['id'] ?>'">
                                    Details
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <ul class="pagination-list">
                <li class="pagination-item">
                    <a href="?page=<?= ($page > 1) ? $page - 1 : 1 ?>" 
                       class="pagination-link <?= ($page == 1) ? 'disabled' : '' ?>">
                        &laquo;
                    </a>
                </li>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="pagination-item">
                        <a href="?page=<?= $i ?>" 
                           class="pagination-link <?= ($i == $page) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                
                <li class="pagination-item">
                    <a href="?page=<?= ($page < $totalPages) ? $page + 1 : $totalPages ?>" 
                       class="pagination-link <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                        &raquo;
                    </a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>

    <?php 
    include "include/footer.php";
    mysqli_close($conn);
    ?>
</body>
</html>