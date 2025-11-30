<?php 
ob_start();
session_start();
include "include/headers.php";
include "config/conn.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate inputs
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
            throw new Exception("All required fields must be filled");
        }

        // Sanitize inputs
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
        $subject = isset($_POST['subject']) ? mysqli_real_escape_string($conn, $_POST['subject']) : null;

        // Prepare SQL statement
        $sql = "INSERT INTO contact_messages (name, email, message, phone, subject) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        if (!$stmt) {
            throw new Exception("Database error: " . mysqli_error($conn));
        }

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $message, $phone, $subject);

        // Execute query
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Message sent successfully!";
            
            // Optionally send email notification
            $to = "info@ecofeedsolutions.com";
            $subject = "New Contact Form Submission";
            $emailMessage = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
            mail($to, $subject, $emailMessage);
        } else {
            throw new Exception("Error sending message: " . mysqli_stmt_error($stmt));
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    } finally {
        // Close connection
        mysqli_close($conn);
        
        // Redirect to prevent form resubmission
        header("Location: contact");
        exit();
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Ecofeedsolution</title>
    <link rel="stylesheet" type="text/css" href="css/footers.css">
       
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Your existing CSS styles here */
       .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        /* Contact Form */
        .contact-info {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 0px;
        }

        .contact-info p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 60px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .contact-form button {
            padding: 12px 24px;
            background: #4CAF50;; /* Deep Ocean Blue */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact-form button:hover {
            background: #4CAF50; /* Darker shade of blue */
        }


   .header-part {
            margin-top: 0px!important;
          
        }
        .header-part h1{
              font-size: 2rem!important;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
       
        
        .header-part {
            margin-top: 0px!important;
        }
        
        .content-section {
            margin: 10px !important;
        }
    </style>
</head>
<body>
    <div class="header-part">
        <h1>Contact us</h1>
    </div>
    
    <!-- Display Success or Error Message -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert error">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
    
    <!-- Contact Us Section -->
    <div class="content-section">
        <div class="contact-info">
            <p><strong>Address:</strong> Guelph, Ontario, Canada N1G 4S7</p>
            <p><strong>Phone:</strong> +1(226) 9626-334</p>
            <p><strong>Email:</strong> ecofeedsolution@gmail.com, info@ecofeedsolutions.com</p>
        </div>
        
        <form class="contact-form" action="" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="tel" name="phone" placeholder="Your Phone (optional)">
            <input type="text" name="subject" placeholder="Subject (optional)">
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <?php include "include/footer.php"; ?>
</body>
</html>