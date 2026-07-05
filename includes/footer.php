<?php
/**
 * Footer Include
 * Footer section of all pages
 */
?>
    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" title="Back to Top">
        <span>↑</span>
    </button>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Footer Content -->
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Elite Barber Shop</h3>
                    <p>Premium barber services with expert stylists and modern techniques.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">f</a>
                        <a href="#" class="social-link" title="Instagram">📷</a>
                        <a href="#" class="social-link" title="Twitter">𝕏</a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo APP_URL; ?>/index.php">Home</a></li>
                        <li><a href="<?php echo APP_URL; ?>/services.php">Services</a></li>
                        <li><a href="<?php echo APP_URL; ?>/team.php">Our Barbers</a></li>
                        <li><a href="<?php echo APP_URL; ?>/appointment.php">Book Appointment</a></li>
                        <li><a href="<?php echo APP_URL; ?>/faq.php">FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="<?php echo APP_URL; ?>/about.php">About Us</a></li>
                        <li><a href="<?php echo APP_URL; ?>/gallery.php">Gallery</a></li>
                        <li><a href="<?php echo APP_URL; ?>/blog.php">Blog</a></li>
                        <li><a href="<?php echo APP_URL; ?>/contact.php">Contact Us</a></li>
                        <li><a href="<?php echo APP_URL; ?>/testimonials.php">Testimonials</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p>
                        <strong>Address:</strong><br>
                        123 Main Street<br>
                        New York, NY 10001
                    </p>
                    <p>
                        <strong>Phone:</strong><br>
                        <a href="tel:+1-555-0100">+1 (555) 0100</a>
                    </p>
                    <p>
                        <strong>Email:</strong><br>
                        <a href="mailto:info@barbershop.com">info@barbershop.com</a>
                    </p>
                </div>
            </div>

            <!-- Newsletter Subscription -->
            <div class="footer-newsletter">
                <h4>Subscribe to Our Newsletter</h4>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-links">
                    <a href="<?php echo APP_URL; ?>/privacy.php">Privacy Policy</a>
                    <a href="<?php echo APP_URL; ?>/terms.php">Terms of Service</a>
                    <a href="<?php echo APP_URL; ?>/sitemap.php">Sitemap</a>
                </div>
                <div class="footer-copyright">
                    <p>&copy; <?php echo date('Y'); ?> Elite Barber Shop. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo APP_URL; ?>/js/script.js"></script>
    <script src="<?php echo APP_URL; ?>/js/slider.js"></script>
    <script src="<?php echo APP_URL; ?>/js/appointment.js"></script>
    <script src="<?php echo APP_URL; ?>/js/validation.js"></script>
    <script src="<?php echo APP_URL; ?>/js/counter.js"></script>
    <script src="<?php echo APP_URL; ?>/js/gallery.js"></script>
    <script src="<?php echo APP_URL; ?>/js/darkmode.js"></script>
</body>
</html>
