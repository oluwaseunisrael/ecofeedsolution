
<?php
include('include/header.php');
include "../config/conn.php";

// Fetch the counts for each table
$blogQuery = "SELECT COUNT(*) as blog_count FROM blog_posts";
$propertyQuery = "SELECT COUNT(*) as property_count FROM properties";
$serviceQuery = "SELECT COUNT(*) as service_count FROM services";
$jobQuery = "SELECT COUNT(*) as job_count FROM jobs";

// Execute queries
$blogResult = mysqli_query($conn, $blogQuery);
$propertyResult = mysqli_query($conn, $propertyQuery);
$serviceResult = mysqli_query($conn, $serviceQuery);
$jobResult = mysqli_query($conn, $jobQuery);

// Fetch the result rows
$blogCount = mysqli_fetch_assoc($blogResult)['blog_count'];
$propertyCount = mysqli_fetch_assoc($propertyResult)['property_count'];
$serviceCount = mysqli_fetch_assoc($serviceResult)['service_count'];
$jobCount = mysqli_fetch_assoc($jobResult)['job_count'];
?>

<!-- Add Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h1 class="text-center">Dashboard Summary</h1>
    
    <!-- Row for Dashboard Cards -->
    <div class="row">
        
        <!-- Blog Posts Card -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Blog Posts</h5>
                    <p class="card-text">Total Blog Posts</p>
                    <h2 class="display-4 text-primary"><?= $blogCount ?></h2>
                    <a href="blog_posts.php" class="btn btn-primary">View Posts</a>
                </div>
            </div>
        </div>

       

    </div>
</div>

<!-- Add Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include('include/footer.php'); ?>
