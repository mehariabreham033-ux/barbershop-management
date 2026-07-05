<?php
/**
 * Header Include
 * Navigation and top section of all pages
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../php/functions.php';

$isLoggedIn = isUserLoggedIn();
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Elite Barber Shop - Premium Barber Services">
    <meta name="keywords" content="barber, haircut, grooming, fade, beard trim">
    <meta property="og:title" content="Elite Barber Shop">
    <meta property="og:description" content="Premium Barber Shop Services">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo APP_URL; ?>">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/css/responsive.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/css/animations.css">
</head>
<body>
    <!-- Loading Screen -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="<?php echo APP_URL; ?>/index.php">
                    <span class="logo-text">Elite Barber</span>
                </a>
            </div>

            <div class="navbar-menu" id="navMenu">
                <ul class="nav-list">
                    <li><a href="<?php echo APP_URL; ?>/index.php" class="nav-link <?php echo $currentPage === 'index' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="<?php echo APP_URL; ?>/about.php" class="nav-link <?php echo $currentPage === 'about' ? 'active' : ''; ?>">About</a></li>
                    <li><a href="<?php echo APP_URL; ?>/services.php" class="nav-link <?php echo $currentPage === 'services' ? 'active' : ''; ?>">Services</a></li>
                    <li><a href="<?php echo APP_URL; ?>/team.php" class="nav-link <?php echo $currentPage === 'team' ? 'active' : ''; ?>">Our Barbers</a></li>
                    <li><a href="<?php echo APP_URL; ?>/gallery.php" class="nav-link <?php echo $currentPage === 'gallery' ? 'active' : ''; ?>">Gallery</a></li>
                    <li><a href="<?php echo APP_URL; ?>/blog.php" class="nav-link <?php echo $currentPage === 'blog' ? 'active' : ''; ?>">Blog</a></li>
                    <li><a href="<?php echo APP_URL; ?>/contact.php" class="nav-link <?php echo $currentPage === 'contact' ? 'active' : ''; ?>">Contact</a></li>
                    <?php if ($isLoggedIn): ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link">Account</a>
                            <div class="dropdown-content">
                                <a href="<?php echo APP_URL; ?>/appointments.php">My Appointments</a>
                                <a href="<?php echo APP_URL; ?>/profile.php">Profile</a>
                                <a href="<?php echo APP_URL; ?>/logout.php">Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo APP_URL; ?>/login.php" class="nav-link">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="navbar-toggle" id="navToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <div class="navbar-actions">
                <a href="<?php echo APP_URL; ?>/appointment.php" class="btn btn-primary">Book Now</a>
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    <span class="toggle-icon">🌙</span>
                </button>
            </div>
        </div>
    </nav>
