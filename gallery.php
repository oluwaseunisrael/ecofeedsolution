<?php include"include/headers.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
    <link rel="stylesheet" type="text/css" href="css/about.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .header-part h1 {
            font-size: 2rem!important;
        }
        
        /* Gallery Styles */
        .gallery-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .gallery-intro {
            text-align: center;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .gallery-intro p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            background: #fff;
        }
        
        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        /* Lightbox Styles */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .lightbox.active {
            display: flex;
            opacity: 1;
        }
        
        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
            animation: zoomIn 0.3s ease;
        }
        
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .lightbox-img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.5);
        }
        
        .lightbox-caption {
            color: white;
            text-align: center;
            margin-top: 15px;
            font-size: 1.1rem;
        }
        
        .lightbox-close {
            position: absolute;
            top: 25px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.3s ease;
        }
        
        .lightbox-close:hover {
            color: #2e7d32;
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 40px;
            cursor: pointer;
            background: rgba(0,0,0,0.5);
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: background 0.3s ease;
        }
        
        .lightbox-nav:hover {
            background: rgba(46, 125, 50, 0.7);
        }
        
        .lightbox-prev {
            left: 30px;
        }
        
        .lightbox-next {
            right: 30px;
        }
        
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
            
            .lightbox-nav {
                font-size: 30px;
                width: 50px;
                height: 50px;
            }
            
            .lightbox-prev {
                left: 15px;
            }
            
            .lightbox-next {
                right: 15px;
            }
            
            .lightbox-close {
                top: 15px;
                right: 20px;
                font-size: 35px;
            }
        }
        
        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            
            .gallery-item img {
                height: 220px;
            }
        }
    </style>
</head>
<body>
   <!-- Gallery Header -->
   <div class="header-part" style="margin-top:0!important;">
        <h1>Our Gallery</h1>
    </div>
    
    <!-- Gallery Content -->
    <div class="gallery-container">
        <!-- Gallery Introduction -->
        <div class="gallery-intro">
            <p>Welcome to our gallery showcasing the essence of EcoFeed Solutions. Explore our commitment to sustainability, innovation, and creating a greener future through our visual journey.</p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <!-- Image 1 -->
            <div class="gallery-item">
                <img src="img/o.jpg" alt="Sustainable Innovation">
            </div>
            
            <!-- Image 2 -->
            <div class="gallery-item">
                <img src="img/two.jpg" alt="Green Technology">
            </div>
            
            <!-- Image 3 -->
            <div class="gallery-item">
                <img src="img/three.jpg" alt="Eco-Friendly Solutions">
            </div>
            
            <!-- Image 4 -->
            <div class="gallery-item">
                <img src="img/four.jpg" alt="Quality Assurance">
            </div>
            
          
            
          
        </div>
    </div>
    
    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <span class="lightbox-close" id="lightbox-close">&times;</span>
        <div class="lightbox-nav lightbox-prev" id="lightbox-prev">&#10094;</div>
        <div class="lightbox-nav lightbox-next" id="lightbox-next">&#10095;</div>
        <div class="lightbox-content">
            <img class="lightbox-img" id="lightbox-img" src="" alt="">
            <div class="lightbox-caption" id="lightbox-caption"></div>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lightbox functionality
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const lightboxClose = document.getElementById('lightbox-close');
            const lightboxPrev = document.getElementById('lightbox-prev');
            const lightboxNext = document.getElementById('lightbox-next');
            
            let currentImageIndex = 0;
            const galleryItems = document.querySelectorAll('.gallery-item');
            const images = Array.from(galleryItems);
            
            // Open lightbox when clicking on gallery item
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentImageIndex = index;
                    updateLightbox();
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling
                });
            });
            
            // Close lightbox
            lightboxClose.addEventListener('click', function() {
                lightbox.classList.remove('active');
                document.body.style.overflow = 'auto'; // Re-enable scrolling
            });
            
            // Navigate to previous image
            lightboxPrev.addEventListener('click', function() {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                updateLightbox();
            });
            
            // Navigate to next image
            lightboxNext.addEventListener('click', function() {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                updateLightbox();
            });
            
            // Update lightbox content
            function updateLightbox() {
                const currentItem = images[currentImageIndex];
                const imgSrc = currentItem.querySelector('img').getAttribute('src');
                const caption = currentItem.querySelector('img').getAttribute('alt');
                
                lightboxImg.setAttribute('src', imgSrc);
                lightboxCaption.textContent = caption;
            }
            
            // Close lightbox when clicking outside the image
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) {
                    lightbox.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (lightbox.classList.contains('active')) {
                    if (e.key === 'Escape') {
                        lightbox.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    } else if (e.key === 'ArrowLeft') {
                        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                        updateLightbox();
                    } else if (e.key === 'ArrowRight') {
                        currentImageIndex = (currentImageIndex + 1) % images.length;
                        updateLightbox();
                    }
                }
            });
        });
    </script>
</body>
</html>
<?php include"include/footer.php"?>