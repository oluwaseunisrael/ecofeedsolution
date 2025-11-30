<?php
include('include/header.php');
include "../config/conn.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM services WHERE id = $id");
$service = mysqli_fetch_assoc($result);

if (!$service) {
    $_SESSION['status'] = "Service not found.";
    header('Location: view-service.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subdescription = mysqli_real_escape_string($conn, $_POST['subdescription']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $benefit = mysqli_real_escape_string($conn, $_POST['benefit']);
    $updateQuery = "";

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if ($imageExt == 'jpg' && $imageSize <= 10485760) {
            $newImageName = uniqid() . '.' . $imageExt;
            $imageUploadPath = '../uploads/' . $newImageName;
            move_uploaded_file($imageTmpName, $imageUploadPath);
            unlink('../uploads/' . $service['image']); // Remove old image

            $updateQuery = "UPDATE services SET image = '$newImageName', title = '$title', 
                            subdescription = '$subdescription', description = '$description', 
                            benefit = '$benefit' WHERE id = $id";
        } else {
            $_SESSION['status'] = "Only JPG files under 10MB are allowed.";
            exit();
        }
    } else {
        $updateQuery = "UPDATE services SET title = '$title', subdescription = '$subdescription', 
                        description = '$description', benefit = '$benefit' WHERE id = $id";
    }

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['status'] = "Service updated successfully.";
        header('Location: view-service.php');
        exit();
    } else {
        $_SESSION['status'] = "Database error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Service</h1>
    <?php if (isset($_SESSION['status'])): ?>
        <div class="alert alert-info"><?= $_SESSION['status']; unset($_SESSION['status']); ?></div>
    <?php endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($service['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="subdescription" class="form-label">Subdescription</label>
            <input type="text" name="subdescription" id="subdescription" class="form-control" value="<?= htmlspecialchars($service['subdescription']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($service['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="benefit" class="form-label">Benefit</label>
            <textarea name="benefit" id="benefit" class="form-control" rows="4" required><?= htmlspecialchars($service['benefit']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (Optional)</label><br>
            <img src="../uploads/<?= htmlspecialchars($service['image']) ?>" alt="Service Image" width="150" class="mb-2">
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update Service</button>
        <a href="view-service.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
