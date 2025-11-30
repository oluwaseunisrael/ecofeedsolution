<?php

include "../config/conn.php";
include('include/header.php');
// Handle delete functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM blog_posts WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "Post deleted successfully.";
    } else {
        $_SESSION['status'] = "Error: " . $conn->error;
    }
    header("Location: view_blogs.php");
    exit;
}

// Fetch all posts
$sql = "SELECT * FROM blog_posts ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Blog Posts</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>All Blog Posts</h2>

        <?php
        // Display session status message if set
        if (isset($_SESSION['status'])) {
            echo '<div class="alert alert-info" role="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']); // Clear the session message
        }
        ?>

        <a href="add_blog.php" class="btn btn-primary mb-3">Add New Blog Post</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                   
                    <th scope="col">Subdescription</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($post = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        
                        <td><?php echo $post['subdescription']; ?></td>
                        <td><img src="../uploads/<?php echo $post['image']; ?>" alt="image" width="100"></td>
                        <td>
                            <a href="edit_blog.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="view_blogs.php?delete=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
