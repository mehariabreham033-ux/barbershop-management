<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="About our premium barbershop - Learn about our history, mission, and expert barbers.">
    <title>About Us - Barbershop Management System</title>
    
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
            <h1>About Us</h1>
            <p>Discover the story behind our premium barbershop</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="grid-2">
                <div class="animate-slide-in-left">
                    <img src="images/about-image.jpg" alt="Our Barbershop" class="about-image">
                </div>
                <div class="animate-slide-in-right">
                    <h2>Our Story</h2>
                    <p>Founded in 2016, our barbershop has been dedicated to providing premium grooming services to our community. With a passion for excellence and attention to detail, we've built a reputation as one of the finest barbershops in the area.</p>
                    <p>Our team of experienced barbers is committed to staying up-to-date with the latest trends and techniques in men's grooming. We believe that a great haircut is more than just cutting hair—it's about creating confidence and style.</p>
                    <h3>Our Mission</h3>
                    <p>To provide exceptional grooming services in a welcoming environment where every customer feels valued and appreciated.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2>Our Team</h2>
            <div class="grid-4 stagger-item">
                <div class="team-card">
                    <img src="images/barber-1.jpg" alt="John Doe">
                    <h3>John Doe</h3>
                    <p>Senior Barber</p>
                    <p class="text-light">15+ years of experience</p>
                </div>
                <div class="team-card">
                    <img src="images/barber-2.jpg" alt="Mike Johnson">
                    <h3>Mike Johnson</h3>
                    <p>Master Barber</p>
                    <p class="text-light">12+ years of experience</p>
                </div>
                <div class="team-card">
                    <img src="images/barber-3.jpg" alt="David Smith">
                    <h3>David Smith</h3>
                    <p>Certified Barber</p>
                    <p class="text-light">8+ years of experience</p>
                </div>
                <div class="team-card">
                    <img src="images/barber-4.jpg" alt="James Brown">
                    <h3>James Brown</h3>
                    <p>Certified Barber</p>
                    <p class="text-light">6+ years of experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us-section">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div class="grid-3 stagger-item">
                <div class="feature-box">
                    <div class="feature-icon">⭐</div>
                    <h3>Expert Barbers</h3>
                    <p>Our team consists of certified and experienced barbers with years of expertise.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">🎯</div>
                    <h3>Premium Quality</h3>
                    <p>We use only the finest products and tools for the best results.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">😊</div>
                    <h3>Customer Satisfaction</h3>
                    <p>Your satisfaction is our priority. We ensure every customer leaves happy.</p>
                </div>
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
    <script src="js/darkmode.js"></script>
    <script src="js/validation.js"></script>
</body>
</html>
