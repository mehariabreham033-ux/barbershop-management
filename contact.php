<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact our barbershop - Get in touch with us for inquiries and feedback.">
    <title>Contact Us - Barbershop Management System</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <!-- Loader -->
    <div id="loader" class="loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">✂️ BarberShop</div>
            <button id="navToggle" class="navbar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul id="navMenu" class="navbar-menu">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="appointments.php" class="nav-link">Appointments</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link">More ▼</a>
                    <div class="dropdown-content">
                        <a href="gallery.php">Gallery</a>
                        <a href="contact.php">Contact</a>
                        <a href="login.php">Login</a>
                    </div>
                </li>
            </ul>
            <div class="navbar-actions">
                <button id="themeToggle" class="btn-icon">🌙</button>
                <a href="appointments.php" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="grid-2">
                <div class="contact-form-wrapper">
                    <h2>Send us a Message</h2>
                    <form id="contactForm" data-validate="true">
                        <div class="form-group">
                            <label for="contact_name">Full Name *</label>
                            <input type="text" id="contact_name" name="name" required minlength="3">
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Email Address *</label>
                            <input type="email" id="contact_email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_phone">Phone Number</label>
                            <input type="tel" id="contact_phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="contact_subject">Subject *</label>
                            <input type="text" id="contact_subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_message">Message *</label>
                            <textarea id="contact_message" name="message" rows="5" required minlength="10" maxlength="1000"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <div class="contact-info-wrapper">
                    <h2>Contact Information</h2>
                    
                    <div class="contact-info-box">
                        <h3>📍 Address</h3>
                        <p>123 Main Street</p>
                        <p>City, State 12345</p>
                        <p>Country</p>
                    </div>

                    <div class="contact-info-box">
                        <h3>📞 Phone</h3>
                        <p><a href="tel:+15551234567">(555) 123-4567</a></p>
                        <p><a href="tel:+15559876543">(555) 987-6543</a></p>
                    </div>

                    <div class="contact-info-box">
                        <h3>📧 Email</h3>
                        <p><a href="mailto:info@barbershop.com">info@barbershop.com</a></p>
                        <p><a href="mailto:support@barbershop.com">support@barbershop.com</a></p>
                    </div>

                    <div class="contact-info-box">
                        <h3>🕐 Business Hours</h3>
                        <p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                        <p><strong>Saturday:</strong> 10:00 AM - 5:00 PM</p>
                        <p><strong>Sunday:</strong> Closed</p>
                    </div>

                    <div class="contact-info-box">
                        <h3>🔗 Follow Us</h3>
                        <div class="social-links">
                            <a href="#" class="social-link">Facebook</a>
                            <a href="#" class="social-link">Instagram</a>
                            <a href="#" class="social-link">Twitter</a>
                            <a href="#" class="social-link">LinkedIn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2>Find Us</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.1234567890!2d-74.0060!3d40.7128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQyJzQ2LjEiTiA3NMKwMDAnMjEuNiJX!5e0!3m2!1sen!2sus!4v1234567890" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>About Us</h4>
                    <p>Premium barbershop offering professional haircuts, grooming, and styling services since 2016.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="about.php">About</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="appointments.php">Book Appointment</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p>📍 123 Main Street, City, State</p>
                    <p>📞 (555) 123-4567</p>
                    <p>📧 info@barbershop.com</p>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Barbershop Management System. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">↑</button>

    <!-- JavaScript Files -->
    <script src="js/script.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>
