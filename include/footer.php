<!-- Footer Section -->
<div class="footer">
    <div class="footer-grid">
        <!-- Quick Links -->
        <div>
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index">Home</a></li>
                <li><a href="about">About Us</a></li>
                <li><a href="blog">Blog</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </div>
        
        <!-- Social Media Links -->
        <div>
            <h3>Follow Us</h3>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p><strong>Address:</strong> Guelph, Ontario, Canada N1G 4S7</p>
            <p><strong>Phone:</strong> +1(226) 9626-334</p>
            <p><strong>Email:</strong> ecofeedsolution@gmail.com, </p>
            <p>info@ecofeedsolutions.com</p>
        </div>
        
        <!-- Newsletter -->
        <div>
            <h3>Newsletter</h3>
            <form class="newsletter" id="newsletter-form">
                <input type="email" id="newsletter-email" placeholder="Enter your email" required>
                <button type="submit" style="margin-top:10px;">Subscribe</button>
            </form>
            <div id="newsletter-message"></div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="copyright">
        &copy; 2025 Ecofeedsolutions. All rights reserved.
    </div>
</div>

<!-- Newsletter Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#newsletter-form").submit(function(e) {
        e.preventDefault();
        var email = $("#newsletter-email").val();
        
        $.ajax({
            type: "POST",
            url: "subscribe.php",
            data: { email: email },
            dataType: "json",
            success: function(response) {
                $("#newsletter-message").html(
                    '<div class="' + response.status + '">' + response.message + '</div>'
                );
                if (response.status === "success") {
                    $("#newsletter-email").val("");
                }
            },
            error: function(xhr, status, error) {
                $("#newsletter-message").html(
                    '<div class="error">Error: ' + error + '</div>'
                );
            }
        });
    });
});
</script>