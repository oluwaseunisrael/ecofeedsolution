<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sebiba</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .login-page {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .login-form-container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 400px;
      width: 100%;
    }
    .form-title {
      margin-bottom: 24px;
      font-size: 24px;
      font-weight: 600;
      text-align: center;
    }
    .alert {
      margin-bottom: 24px;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .form-icon {
      margin-right: 10px;
    }
  </style>
</head>
<body>

<div class="login-page">
  <div class="login-form-container">
    <?php if (isset($_SESSION['status'])): ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
            icon: 'info',
            title: 'Notice',
            text: '<?php echo $_SESSION['status']; unset($_SESSION['status']); ?>',
          });
        });
      </script>
    <?php endif; ?>
    <h3 class="form-title">Login</h3>
    <form action="logincode.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">
          <i class="fas fa-user form-icon"></i>Username
        </label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">
          <i class="fas fa-lock form-icon"></i>Password
        </label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>
      <input type="submit" class="btn btn-primary w-100" name="login" value="Login">
    
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
