<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sebiiba Admin Panel</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .navbar {
      background-color: #343a40!important;
      padding: 10px 6%!important;
    }
    .navbar-brand {
      color: #ffffff!important;
      font-weight: bold!important;
    }
    .navbar-brand:hover {
      color: #17a2b8!important;
    }
    .nav-link {
      color: #ffffff!important;
      margin-right: 15px!important;
      transition: color 0.3s ease!important;
    }
    .nav-link:hover, .nav-link.active {
      color: #17a2b8!important;
    }
    .dropdown-menu {
      background-color: #343a40!important;
      border: none!important;
    }
    .dropdown-item {
      color: #ffffff!important;
    }
    .dropdown-item:hover {
      background-color: #495057!important;
    }
    .avatar {
      border: 2px solid #ffffff!important;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> Admin</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="admin-table.php">Admin view</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="view_blogs.php">Blog View</a>
          </li>
             <li class="nav-item">
            <a class="nav-link" href="add_product.php">Add product</a>
          </li>
             <li class="nav-item">
            <a class="nav-link" href="view_products.php">product View</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li>
                <a class="dropdown-item" href="Logout.php">Logout</a>
              </li>
          
            
            
              
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
