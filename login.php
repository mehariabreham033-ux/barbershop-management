<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to your barbershop account - Access your appointments and profile.">
    <title>Login - Barbershop Management System</title>
    
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

    <!-- Login Section -->
    <section class="login-section">
        <div class="login-container">
            <div class="login-form-wrapper">
                <div class="login-header">
                    <h1>✂️ BarberShop</h1>
                    <p>Login to Your Account</p>
                </div>

                <form id="loginForm" data-validate="true">
                    <div class="form-group">
                        <label for="login_email">Email Address *</label>
                        <input type="email" id="login_email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="login_password">Password *</label>
                        <div class="password-input">
                            <input type="password" id="login_password" name="password" required>
                            <button type="button" class="password-toggle">👁️</button>
                        </div>
                    </div>

                    <div class="form-group checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <div class="login-footer">
                    <p><a href="#">Forgot Password?</a></p>
                    <p>Don't have an account? <a href="#">Sign up here</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Files -->
    <script src="js/script.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/darkmode.js"></script>
    <script>
        // Toggle password visibility
        const passwordToggle = document.querySelector('.password-toggle');
        const passwordInput = document.querySelector('#login_password');
        
        if (passwordToggle) {
            passwordToggle.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                passwordToggle.textContent = type === 'password' ? '👁️' : '🙈';
            });
        }
    </script>
</body>
</html>
