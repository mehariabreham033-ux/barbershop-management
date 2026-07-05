<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Our premium barbershop services - Haircuts, beard grooming, shaving, and more.">
    <title>Services - Barbershop Management System</title>
    
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
            <h1>Our Services</h1>
            <p>Premium grooming services tailored to your needs</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-section">
        <div class="container">
            <div class="grid-3 stagger-item">
                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <span class="service-icon">✂️</span>
                    </div>
                    <h3>Haircut</h3>
                    <p>Professional haircuts using the latest techniques and styles. Our expert barbers will work with you to find the perfect look.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> 30-45 minutes</p>
                        <p><strong>Price:</strong> $25-$40</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>

                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <span class="service-icon">🧔</span>
                    </div>
                    <h3>Beard Grooming</h3>
                    <p>Expert beard trimming, shaping, and styling. We use premium beard oils and products for the best results.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> 20-30 minutes</p>
                        <p><strong>Price:</strong> $15-$25</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>

                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <span class="service-icon">🪒</span>
                    </div>
                    <h3>Shaving</h3>
                    <p>Traditional wet shaving with hot towel treatment. A luxurious experience using premium shaving cream and aftershave.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> 20-25 minutes</p>
                        <p><strong>Price:</strong> $20-$30</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>

                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <span class="service-icon">💇</span>
                    </div>
                    <h3>Hair Coloring</h3>
                    <p>Professional hair coloring services with premium dyes. We offer various shades and can create custom colors.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> 45-60 minutes</p>
                        <p><strong>Price:</strong> $35-$55</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>

                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                        <span class="service-icon">💆</span>
                    </div>
                    <h3>Scalp Massage</h3>
                    <p>Relaxing scalp massage to improve circulation and relieve tension. A perfect addition to any service.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> 15-20 minutes</p>
                        <p><strong>Price:</strong> $15-$20</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>

                <div class="service-card-detailed">
                    <div class="service-image" style="background: linear-gradient(135deg, #ff9a56 0%, #ff6a88 100%);">
                        <span class="service-icon">👨‍👧‍👦</span>
                    </div>
                    <h3>Family Packages</h3>
                    <p>Special packages for families. Get discounts when booking multiple services for your family members.</p>
                    <div class="service-details">
                        <p><strong>Duration:</strong> Varies</p>
                        <p><strong>Price:</strong> Custom pricing</p>
                    </div>
                    <a href="appointments.php" class="btn btn-outline">Book Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <h2>Pricing</h2>
            <div class="pricing-table">
                <table>
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Duration</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Haircut</td>
                            <td>30-45 min</td>
                            <td>$25-$40</td>
                        </tr>
                        <tr>
                            <td>Beard Grooming</td>
                            <td>20-30 min</td>
                            <td>$15-$25</td>
                        </tr>
                        <tr>
                            <td>Shaving</td>
                            <td>20-25 min</td>
                            <td>$20-$30</td>
                        </tr>
                        <tr>
                            <td>Hair Coloring</td>
                            <td>45-60 min</td>
                            <td>$35-$55</td>
                        </tr>
                        <tr>
                            <td>Scalp Massage</td>
                            <td>15-20 min</td>
                            <td>$15-$20</td>
                        </tr>
                    </tbody>
                </table>
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
