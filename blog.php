<?php
include "include/headers.php";
include "config/conn.php";

// Pagination logic
$limit = 3; // Number of posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of posts
$total_posts_query = "SELECT COUNT(*) as total FROM blog_posts";
$total_posts_result = mysqli_query($conn, $total_posts_query);
$total_posts_row = mysqli_fetch_assoc($total_posts_result);
$total_posts = $total_posts_row['total'];

// Calculate total pages
$total_pages = ceil($total_posts / $limit);

// Fetch posts for the current page
$query = "SELECT * FROM blog_posts ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Post - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <link rel="stylesheet" type="text/css" href="css/blog.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>/* Pagination Container */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}

/* Pagination Links */
.pagination a {
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    margin: 0 4px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

/* Hover Effect */
.pagination a:hover {
    background-color:#003366;
    color: white;
    border-color: #003366;
}

/* Active Page */
.pagination a.active {
    background-color: #003366;
    color: white;
    border-color: #003366;
    cursor: default;
}
       .header-part h1{
              font-size: 2rem!important;
        }
/* Previous and Next Buttons */
.pagination a:first-child,
.pagination a:last-child {
    background-color: #f8f9fa;
    color: #003366;
    border: 1px solid #ddd;
}

.pagination a:first-child:hover,
.pagination a:last-child:hover {
    background-color:#003366;
    color: white;
}

/* Disabled State for Previous/Next (Optional) */
.pagination a.disabled {
    color: #ccc;
    pointer-events: none;
    border-color: #ddd;
}</style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-part" style ="margin-top:0!important;">
        <h1>  Blog Highlights</h1>
    </div>

    <!-- Blog Highlights Section -->
    <div class="blog-highlights">
        <h2> Blog Highlights</h2>
        <div class="blog-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="blog-item">
                        <div class="image-container">
                            <img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '">
                            <div class="date-overlay">' . date("M d, Y", strtotime($row['created_at'])) . '</div>
                        </div>
                        <h3>' . $row['title'] . '</h3>
                        <p>' . substr($row['description'], 0, 100) . '...</p>
                        <a href="single-post?id=' . $row['id'] . '">Read More</a>
                    </div>';
                }
            } else {
                echo '<p>No blog posts found.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">Previous</a>';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page=' . $i . '" ' . ($page == $i ? 'class="active"' : '') . '>' . $i . '</a>';
        }
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">Next</a>';
        }
        ?>
    </div>

    <!-- Footer Section -->
    <?php include "include/footer.php"; ?>
</body>
</html>