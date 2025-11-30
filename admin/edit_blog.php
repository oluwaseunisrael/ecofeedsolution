<?php
session_start(); // Start the session
include "../config/conn.php";

// Retrieve post ID from query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the existing post details
    $sql = "SELECT * FROM blog_posts WHERE id = $id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();

    if (!$post) {
        $_SESSION['status'] = "Post not found.";
        header("Location: view_blogs.php");
        exit;
    }
} else {
    $_SESSION['status'] = "No post ID provided.";
    header("Location: view_blogs.php");
    exit;
}

// Handle form submission to update blog post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $subdescription = $_POST['subdescription'];

    // Handle image upload (optional)
    $image = $post['image']; // Keep the existing image unless a new one is uploaded

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadedImage = $_FILES['image'];
        $imageName = basename($uploadedImage['name']);
        $imageTmpName = $uploadedImage['tmp_name'];
        $imageSize = $uploadedImage['size'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate image type
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageType, $allowedTypes)) {
            $_SESSION['status'] = "Error: Only JPG, JPEG, and PNG files are allowed.";
            header("Location: edit_blog.php?id=$id");
            exit;
        }

        // Validate image size (e.g., max 2MB)
        if ($imageSize > 2 * 1024 * 1024) {
            $_SESSION['status'] = "Error: File size exceeds 2MB.";
            header("Location: edit_blog.php?id=$id");
            exit;
        }

        // Define upload directory
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique filename to prevent overwriting
        $uniqueImageName = uniqid('img_', true) . '.' . $imageType;
        $uploadPath = $uploadDir . $uniqueImageName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($imageTmpName, $uploadPath)) {
            $image = $uniqueImageName;
        } else {
            $_SESSION['status'] = "Error: There was an issue uploading your file.";
            header("Location: edit_blog.php?id=$id");
            exit;
        }
    }

    // Update the post in the database
    $sql = "UPDATE blog_posts SET title='$title', description='$description', subdescription='$subdescription', image='$image' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "Post updated successfully.";
    } else {
        $_SESSION['status'] = "Error: " . $conn->error;
    }
    header("Location: view_blogs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Blog Post</h2>

        <?php
        // Display session status message if set
        if (isset($_SESSION['status'])) {
            echo '<div class="alert alert-info" role="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']); // Clear the session message
        }
        ?>

        <form action="edit_blog.php?id=<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required><?php echo $post['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="subdescription" class="form-label">Subdescription:</label>
                <textarea id="subdescription" name="subdescription" class="form-control" required><?php echo $post['subdescription']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image (JPG or PNG):</label>
                <input type="file" id="image" name="image" class="form-control" accept=".jpg, .jpeg, .png">
                <small class="form-text text-muted">Leave empty if you don't want to change the image.</small>
            </div>

            <div class="mb-3">
                <img src="uploads/<?php echo $post['image']; ?>" alt="current image" width="100">
            </div>

            <button type="submit" class="btn btn-primary" name="update_post">Update Post</button>
        </form>

        <a href="view_blogs.php" class="btn btn-secondary mt-3">Back to Blog List</a>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
