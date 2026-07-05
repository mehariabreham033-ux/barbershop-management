<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View our barbershop gallery - Professional haircuts and grooming services.">
    <title>Gallery - Barbershop Management System</title>
    
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
            <h1>Gallery</h1>
            <p>See our finest work and transformations</p>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="gallery-page-section">
        <div class="container">
            <div class="gallery-grid">
                <img src="images/gallery-1.jpg" alt="Professional Haircut" data-gallery="images/gallery-1.jpg" data-caption="Professional Haircut">
                <img src="images/gallery-2.jpg" alt="Beard Styling" data-gallery="images/gallery-2.jpg" data-caption="Expert Beard Styling">
                <img src="images/gallery-3.jpg" alt="Hair Transformation" data-gallery="images/gallery-3.jpg" data-caption="Hair Transformation">
                <img src="images/gallery-4.jpg" alt="Family Haircuts" data-gallery="images/gallery-4.jpg" data-caption="Family Services">
                <img src="images/gallery-5.jpg" alt="Classic Haircut" data-gallery="images/gallery-5.jpg" data-caption="Classic Haircut">
                <img src="images/gallery-6.jpg" alt="Modern Style" data-gallery="images/gallery-6.jpg" data-caption="Modern Style">
                <img src="images/gallery-7.jpg" alt="Fade Haircut" data-gallery="images/gallery-7.jpg" data-caption="Fade Haircut">
                <img src="images/gallery-8.jpg" alt="Premium Grooming" data-gallery="images/gallery-8.jpg" data-caption="Premium Grooming">
                <img src="images/gallery-9.jpg" alt="Beard Trim" data-gallery="images/gallery-9.jpg" data-caption="Professional Beard Trim">
                <img src="images/gallery-10.jpg" alt="Hair Color" data-gallery="images/gallery-10.jpg" data-caption="Hair Coloring Service">
                <img src="images/gallery-11.jpg" alt="Client Satisfaction" data-gallery="images/gallery-11.jpg" data-caption="Happy Customers">
                <img src="images/gallery-12.jpg" alt="Our Barbers" data-gallery="images/gallery-12.jpg" data-caption="Our Expert Team">
            </div>
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
    <script src="js/gallery.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>
