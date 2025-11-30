<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Learn about larva feeding for fish, including the best practices, types of larvae, and how to optimize nutrition for healthy fish growth.">
    <meta name="keywords" content="larva feeding, fish larvae, fish nutrition, feeding fish larvae, aquaculture, fish farming">
    <meta name="author" content="Ecofeed solutions">
    <title>Larva Feeding for Fish: Best Practices and Tips</title>
    <link rel="canonical" href="https://www.ecofeedsolutions.com/larva-feeding-for-fish">
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <link rel="icon" href="img/logo2.png" type="image/x-icon">
    <!-- Google Font: Poppins -->
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
            top:0;
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
         

            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 250px;
                background:  #4CAF50;; /* Deep Ocean Blue */
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


        .slider {
            
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: auto;
            margin-top:0px!important;
            overflow: hidden;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
        }

        .slide .content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
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
                <li><a href="product.php">Product</a></li>
                <li><a href="blog">Blog</a></li>
                 <li><a href="gallery">Gallery</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </div>
    </div>

    <!-- Background Section with Content -->
    

    <div class="slider">
        <div class="slides">
             <div class="slide active">
                <img src="img/larvae.jpg" alt="Organic Protein">
                <div class="content">
                    <h1>Organic Protein</h1>
                   
                </div>
            </div>
            <div class="slide ">
                <img src="img/soils.jpg" alt="Organic Fertilizer">
                <div class="content">
                    <h1>Organic Fertilizer</h1>
                    
                </div>
            </div>
           
            <div class="slide">
                <img src="img/fish.jpg" alt="FORFISH">
                <div class="content">
                    <h1>Super feed for fish</h1>
                   
                </div>
            </div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>
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
    <script>
        let currentSlide = 0;
        const slidesContainer = document.querySelector('.slides');
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            const offset = -index * 100;
            slidesContainer.style.transform = `translateX(${offset}%)`;
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Automatically change slides every 5 seconds
        setInterval(nextSlide, 5000);

        // Show the first slide initially
        showSlide(currentSlide);
    </script>
</body>
</html>