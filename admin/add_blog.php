<?php
session_start(); // Start the session
include "../config/conn.php"; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_post'])) {
    // Sanitize user inputs to prevent SQL injection
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $subdescription = trim($_POST['subdescription']);
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // Escape user inputs to prevent SQL errors
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $subdescription = mysqli_real_escape_string($conn, $subdescription);

    // Handle image upload
    $image = ''; // Default value if no image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadedImage = $_FILES['image'];
        $imageName = basename($uploadedImage['name']);
        $imageTmpName = $uploadedImage['tmp_name'];
        $imageSize = $uploadedImage['size'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Allowed image types
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageType, $allowedTypes)) {
            $_SESSION['status'] = "Error: Only JPG, JPEG, and PNG files are allowed.";
            header("Location: add_blog.php");
            exit;
        }

        // Validate image size (max 15MB)
        if ($imageSize > 15 * 1024 * 1024) {
            $_SESSION['status'] = "Error: File size exceeds 15MB.";
            header("Location: add_blog.php");
            exit;
        }

        // Create uploads directory if it doesn't exist
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique filename to prevent overwriting
        $uniqueImageName = uniqid('img_', true) . '.' . $imageType;
        $uploadPath = $uploadDir . $uniqueImageName;

        // Move the uploaded file to the directory
        if (move_uploaded_file($imageTmpName, $uploadPath)) {
            $image = $uniqueImageName; // Store only the filename in the database
        } else {
            $_SESSION['status'] = "Error: There was an issue uploading your file.";
            header("Location: add_blog.php");
            exit;
        }
    }

    // Use prepared statements to insert data securely
    $sql = "INSERT INTO blog_posts (title, description, subdescription, image, created_at) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $description, $subdescription, $image, $created_at);

    if ($stmt->execute()) {
        $_SESSION['status'] = "New blog post added successfully.";
        header("Location: view_blogs.php");
        exit;
    } else {
        $_SESSION['status'] = "Error: " . $stmt->error;
        header("Location: add_blog.php");
        exit;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog Post</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Blog Post</h2>

        <?php
        // Display session status message if set
        if (isset($_SESSION['status'])) {
            echo '<div class="alert alert-info" role="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']); // Clear the session message
        }
        ?>

        <form action="add_blog.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="subdescription" class="form-label">Subdescription:</label>
                <textarea id="subdescription" name="subdescription" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image (JPG or PNG):</label>
                <input type="file" id="image" name="image" class="form-control" accept=".jpg, .jpeg, .png">
            </div>

            <button type="submit" class="btn btn-primary" name="add_post">Add Post</button>
        </form>

        <a href="view_blogs.php" class="btn btn-secondary mt-3">Back to Blog List</a>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
