<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium barbershop management system - Book appointments, view services, and manage your barber needs online.">
    <meta name="keywords" content="barbershop, haircut, grooming, appointments, barbers">
    <meta name="author" content="Barbershop Management">
    <title>Barbershop Management System</title>
    
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
                <li><a href="#home" class="nav-link">Home</a></li>
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

    <!-- Hero Section -->
    <section id="home" class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="hero-content">
                <h1 class="animate-slide-in-up">Premium Barber Services</h1>
                <p class="animate-slide-in-up" style="animation-delay: 0.2s;">Experience the finest haircuts and grooming services</p>
                <a href="appointments.php" class="btn btn-primary btn-large animate-slide-in-up" style="animation-delay: 0.4s;">Book Appointment</a>
            </div>
        </div>
    </section>

    <!-- Featured Services -->
    <section class="featured-services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="grid-3 stagger-item">
                <div class="card service-card">
                    <div class="card-icon">✂️</div>
                    <h3>Haircut</h3>
                    <p>Professional haircuts tailored to your style and preference</p>
                    <a href="services.php" class="link">View Details →</a>
                </div>
                <div class="card service-card">
                    <div class="card-icon">🧔</div>
                    <h3>Beard Grooming</h3>
                    <p>Expert beard trimming and styling services</p>
                    <a href="services.php" class="link">View Details →</a>
                </div>
                <div class="card service-card">
                    <div class="card-icon">💈</div>
                    <h3>Shaving</h3>
                    <p>Traditional wet shaving with premium products</p>
                    <a href="services.php" class="link">View Details →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div class="grid-4 stagger-item">
                <div class="stat-box">
                    <div class="stat-number" data-counter data-target="500" data-duration="2000">0</div>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number" data-counter data-target="15" data-duration="2000">0</div>
                    <p>Expert Barbers</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number" data-counter data-target="8" data-duration="2000">0</div>
                    <p>Years Experience</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number" data-counter data-target="2000" data-duration="2000">0</div>
                    <p>Haircuts Completed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Slider -->
    <section class="gallery-section">
        <div class="container">
            <h2>Gallery</h2>
            <div class="slider-container" data-slider>
                <div class="slide active" style="background: url('images/gallery-1.jpg'); background-size: cover; background-position: center;">
                    <div class="slide-content">
                        <h3>Professional Haircuts</h3>
                    </div>
                </div>
                <div class="slide" style="background: url('images/gallery-2.jpg'); background-size: cover; background-position: center;">
                    <div class="slide-content">
                        <h3>Beard Styling</h3>
                    </div>
                </div>
                <div class="slide" style="background: url('images/gallery-3.jpg'); background-size: cover; background-position: center;">
                    <div class="slide-content">
                        <h3>Premium Grooming</h3>
                    </div>
                </div>
                <div class="slide" style="background: url('images/gallery-4.jpg'); background-size: cover; background-position: center;">
                    <div class="slide-content">
                        <h3>Family Services</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <h2>Subscribe to Our Newsletter</h2>
            <p>Get exclusive offers and updates delivered to your inbox</p>
            <form id="newsletterForm" class="newsletter-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
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
    <script src="js/slider.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/gallery.js"></script>
    <script src="js/darkmode.js"></script>
    <script src="js/validation.js"></script>
</body>
</html>
