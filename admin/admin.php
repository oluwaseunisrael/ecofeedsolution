<?php

include('include/header.php');
include "../config/conn.php";
?>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .registration-form {
      max-width: 400px;
      margin: 50px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-title {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container">
	 <?php if (isset($_SESSION['status'])): ?>
                <script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Notification',
                    text: '<?= $_SESSION['status'] ?>',
                    confirmButtonColor: '#007bff',
                  });
                </script>
                <?php unset($_SESSION['status']); endif; ?>
  <div class="registration-form">
    <h3 class="form-title">Admin Registration</h3>
    <form action="code.php" method="POST">
      <!-- Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">

      <!-- Confirm Password -->
      <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password" name="cpassword">
      </div>

      <!-- Submit Button -->
      <div class="d-grid">
        <input type="submit" class="btn btn-primary btn-block" value="Register" name="admin">
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
