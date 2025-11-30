<?php
include "include/headers.php";
include "config/conn.php";

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = (int)$_GET['id'];

    // Fetch the blog post from the database
    $query = "SELECT * FROM blog_posts WHERE id = $post_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        // Redirect or show an error if the post doesn't exist
        header("Location: blog.php");
        exit();
    }
} else {
    // Redirect if no 'id' is provided
    header("Location: blog.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($post['']); ?> - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <link rel="stylesheet" type="text/css" href="css/posts.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      <style>
       .header-part h1{
              font-size: 2rem!important;
        }
    </style>
</head>
<body>
    <div class="header-part" style ="margin-top:0!important">
       <h1 class="blog-title"><?php echo date("F j, Y", strtotime($post['created_at'])); ?></h1>
    </div>
    <div class="blog-container">
        <!-- Blog Title -->
        <h1 class="blog-title"><?php echo htmlspecialchars($post['title']); ?></h1>

        <!-- Blog Date -->
        <p class="blog-date">Published on: <?php echo date("F j, Y", strtotime($post['created_at'])); ?></p>

        <!-- Blog Image -->
        <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="blog-image">

        <!-- Blog Description -->
        <p class="blog-description">
            <?php echo nl2br(htmlspecialchars($post['description'])); ?>
        </p>

        <!-- Comments Section -->
        <div class="comments-section">
            <h2>Comments</h2>

            <?php
            // Fetch comments for this post
            $comments_query = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY comment_date DESC";
            $comments_result = mysqli_query($conn, $comments_query);

            if (mysqli_num_rows($comments_result) > 0) {
                while ($comment = mysqli_fetch_assoc($comments_result)) {
                    echo '
                    <div class="comment">
                        <p class="comment-author">' . htmlspecialchars($comment['author_name']) . '</p>
                        <p class="comment-date">' . date("F j, Y", strtotime($comment['comment_date'])) . '</p>
                        <p class="comment-text">' . nl2br(htmlspecialchars($comment['comment_text'])) . '</p>
                    </div>';
                }
            } else {
                echo '<p>No comments yet. Be the first to comment!</p>';
            }
            ?>
        </div>

        <!-- Comment Form -->
        <div class="comment-form">
            <h2>Leave a Comment</h2>
            <form action="submit_comment.php" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include "include/footer.php";
?>