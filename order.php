<?php
include "config/conn.php";

// Check if product ID is provided in URL
$selectedProductId = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

// Get products from database
$query = "SELECT id, title, price FROM products";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get specific product if ID is provided
$selectedProduct = null;
if ($selectedProductId > 0) {
    foreach ($products as $product) {
        if ($product['id'] == $selectedProductId) {
            $selectedProduct = $product;
            break;
        }
    }
}

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $customer_name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $additional_notes = $_POST['notes'];
    
    // Format the message for WhatsApp
    $whatsapp_message = "New Order Request:%0A%0A";
    $whatsapp_message .= "Product: " . urlencode($selected_product) . "%0A";
    $whatsapp_message .= "Quantity: " . urlencode($quantity) . "%0A";
    $whatsapp_message .= "Customer Name: " . urlencode($customer_name) . "%0A";
    $whatsapp_message .= "Phone: " . urlencode($phone) . "%0A";
    $whatsapp_message .= "Address: " . urlencode($address) . "%0A";
    $whatsapp_message .= "Additional Notes: " . urlencode($additional_notes) . "%0A";
    
    // Redirect to WhatsApp with the message
    header("Location: https://wa.me/2349028622243?text=" . $whatsapp_message);
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <style>
      
   
    </style>
</head>
<body>
    <?php include "include/headers.php"; ?>
    
    <div class="order-header">
        <h1>Place Your Order</h1>
    </div>
    
    <div class="order-form">
        <form method="post" action="">
            <div class="form-group">
                <label for="product">Select Product:</label>
                <select id="product" name="product" required>
                    <option value="">-- Select a Product --</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= htmlspecialchars($product['title']) ?><?= ($product['price'] > 0) ? ' - $' . number_format($product['price'], 2) : '' ?>"
                            <?= ($selectedProduct && $product['id'] == $selectedProduct['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($product['title']) ?>
                            <?php if ($product['price'] > 0): ?>
                                ($<?= number_format($product['price'], 2) ?>)
                            <?php else: ?>
                                (Contact for price)
                            <?php endif; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
            </div>
            
            <div class="form-group">
                <label for="name">Your Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="notes" rows="3"></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Place Order via WhatsApp</button>
        </form>
    </div>

    <?php include "include/footer.php"; ?>
</body>
</html>