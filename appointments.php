<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book your appointment at our premium barbershop - Easy online booking system.">
    <title>Book Appointment - Barbershop Management System</title>
    
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
            <h1>Book Your Appointment</h1>
            <p>Reserve your spot with our expert barbers</p>
        </div>
    </section>

    <!-- Appointment Booking Form -->
    <section class="booking-section">
        <div class="container">
            <div class="booking-form-container">
                <div class="form-wrapper">
                    <h2>Appointment Details</h2>
                    <form id="appointmentForm" data-validate="true">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required minlength="3" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required pattern="[0-9+\-\s()]+">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="service_id">Service *</label>
                                <select id="service_id" name="service_id" required>
                                    <option value="">Select Service</option>
                                    <option value="1">Haircut</option>
                                    <option value="2">Beard Grooming</option>
                                    <option value="3">Shaving</option>
                                    <option value="4">Hair Coloring</option>
                                    <option value="5">Scalp Massage</option>
                                    <option value="6">Family Package</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="barber_id">Preferred Barber *</label>
                                <select id="barber_id" name="barber_id" required>
                                    <option value="">Select Barber</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Mike Johnson</option>
                                    <option value="3">David Smith</option>
                                    <option value="4">James Brown</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="appointment_date">Appointment Date *</label>
                                <input type="date" id="appointment_date" name="appointment_date" required>
                            </div>

                            <div class="form-group">
                                <label for="appointment_time">Appointment Time *</label>
                                <select id="appointment_time" name="appointment_time" required>
                                    <option value="">Select Time</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="09:30">09:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="14:30">2:30 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="15:30">3:30 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                    <option value="16:30">4:30 PM</option>
                                    <option value="17:00">5:00 PM</option>
                                    <option value="17:30">5:30 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Additional Notes</label>
                            <textarea id="notes" name="notes" rows="4" placeholder="Any special requests or preferences..."></textarea>
                        </div>

                        <div class="form-group checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the terms and conditions *</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-large">Book Appointment</button>
                    </form>
                </div>

                <div class="booking-info">
                    <h3>Appointment Information</h3>
                    <div class="info-box">
                        <h4>📍 Location</h4>
                        <p>123 Main Street, City, State</p>
                    </div>
                    <div class="info-box">
                        <h4>🕐 Business Hours</h4>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                        <p>Saturday: 10:00 AM - 5:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                    <div class="info-box">
                        <h4>📞 Contact Us</h4>
                        <p>Phone: (555) 123-4567</p>
                        <p>Email: info@barbershop.com</p>
                    </div>
                    <div class="info-box">
                        <h4>❓ Cancellation Policy</h4>
                        <p>Please cancel or reschedule at least 24 hours in advance to avoid cancellation fees.</p>
                    </div>
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
    <script src="js/appointment.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>
