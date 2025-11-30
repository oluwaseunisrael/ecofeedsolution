<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Learn about larva feeding for fish, including the best practices, types of larvae, and how to optimize nutrition for healthy fish growth.">
    <meta name="keywords" content="larva feeding, fish larvae, fish nutrition, feeding fish larvae, aquaculture, fish farming">
    <meta name="author" content="Ecofeed Solutions">
    <title>Larva Feeding for Fish: Best Practices and Tips</title>
    <link rel="canonical" href="https://http://www.ecofeedsolutions.com/larva-feeding-for-fish">
    <link rel="stylesheet" type="text/css" href="../css/footers.css">
    <link rel="icon" href="img/logo2.png" type="image/x-icon">
    <!-- Google Font: Poppins -->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-size: 16px;
            line-height: 1.6;
        }

        /* Header and Navbar */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background:  #4CAF50; /* Semi-transparent Deep Ocean Blue */
            z-index: 1000;
            padding: 10px 20px;
            
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 2%;
        }

        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 70px; /* Adjust the height as needed */
            margin-right: 10px; /* Space between logo and text */
           
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .nav-links li a:hover {
            color: #FFD700; /* Golden Yellow */
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            z-index: 1001;
        }

        .hamburger .line {
            width: 25px;
            height: 3px;
            background: #fff;
            margin: 4px 0;
            transition: all 0.3s ease;
        }

        /* Cancel Button Icon */
        .cancel-btn {
            display: none;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            z-index: 1001;
        }

        .cancel-btn.active {
            display: block;
        }

        /* Mobile Navbar */
        @media (max-width: 768px) {
        	    .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 0%!important;
        }
         .content p {
            font-size: 20px;
            padding: 0 0%;
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }


            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 250px;
                background:  #4CAF50; /* Deep Ocean Blue */
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: right 0.3s ease;
            }

            .nav-links.active {
                right: 0;
            }

            .hamburger {
                display: flex;
            }

            .hamburger.active .line:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }

            .hamburger.active .line:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active .line:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }
        }

        /* Background Section */
        

       

               /* Header Part with Background Image */
        .header-part {
            margin-top: 90px;
            height: 300px; /* Adjust height as needed */
          background: rgba(0, 0, 0, 0.5);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
        }

        
        /* Header Text */
        .header-part h1 {
            font-size: 48px;
            font-weight: 600;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: 2px;
        }


.success {
    color: green;
    font-weight: bold;
    margin-top: 5px;
}

.error {
    color: red;
    font-weight: bold;
    margin-top: 5px;
}

            

    </style>
</head>
<body>
    
    <!-- Header -->
    <div class="header">
        <div class="navbar">
            <a href="#" class="logo">
               
                EcoFeed Solutions
            </a>
            <!-- Hamburger Menu -->
            <div class="hamburger" onclick="toggleMenu()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <!-- Cancel Button Icon -->
           
            <!-- Nav Links -->
            <ul class="nav-links">
                     <li><a href="index">Home</a></li>
                <li><a href="about">About</a></li>
                 <li><a href="product.php"> Product</a></li>
                <li><a href="blog">Blog</a></li>
                 <li><a href="gallery">Gallery</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </div>
    </div>

    <!-- Background Section with Content -->
    

    
    <!-- JavaScript for Hamburger Menu -->
    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            const hamburger = document.querySelector('.hamburger');
            const cancelBtn = document.querySelector('.cancel-btn');
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
            cancelBtn.classList.toggle('active');
        }
    </script>
</body>
</html>