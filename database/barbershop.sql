-- Barber Shop Management System Database
-- Database: barbershop
-- Created for production use

CREATE DATABASE IF NOT EXISTS `barbershop`;
USE `barbershop`;

-- =====================================================
-- ADMIN TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) UNIQUE NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(100),
  `phone` VARCHAR(20),
  `role` ENUM('super_admin', 'admin', 'moderator') DEFAULT 'admin',
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `last_login` TIMESTAMP NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_username` (`username`),
  INDEX `idx_email` (`email`),
  INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- USERS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255),
  `profile_image` VARCHAR(255),
  `total_visits` INT DEFAULT 0,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_email` (`email`),
  INDEX `idx_phone` (`phone`),
  INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SERVICES TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `duration` INT NOT NULL COMMENT 'Duration in minutes',
  `image` VARCHAR(255),
  `category` VARCHAR(50),
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_status` (`status`),
  INDEX `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- BARBERS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `barbers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `phone` VARCHAR(20),
  `photo` VARCHAR(255),
  `experience_years` INT DEFAULT 0,
  `specialization` VARCHAR(255),
  `bio` TEXT,
  `rating` DECIMAL(3, 2) DEFAULT 0,
  `total_reviews` INT DEFAULT 0,
  `facebook` VARCHAR(255),
  `instagram` VARCHAR(255),
  `twitter` VARCHAR(255),
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_status` (`status`),
  INDEX `idx_rating` (`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- APPOINTMENTS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `service_id` INT NOT NULL,
  `barber_id` INT NOT NULL,
  `customer_name` VARCHAR(100) NOT NULL,
  `customer_email` VARCHAR(100) NOT NULL,
  `customer_phone` VARCHAR(20) NOT NULL,
  `appointment_date` DATE NOT NULL,
  `appointment_time` TIME NOT NULL,
  `notes` TEXT,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`barber_id`) REFERENCES `barbers`(`id`) ON DELETE RESTRICT,
  INDEX `idx_user_id` (`user_id`),
  INDEX `idx_service_id` (`service_id`),
  INDEX `idx_barber_id` (`barber_id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_appointment_date` (`appointment_date`),
  UNIQUE KEY `unique_barber_slot` (`barber_id`, `appointment_date`, `appointment_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- GALLERY TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `barber_id` INT,
  `image_path` VARCHAR(255) NOT NULL,
  `title` VARCHAR(100),
  `description` TEXT,
  `category` VARCHAR(50),
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`barber_id`) REFERENCES `barbers`(`id`) ON DELETE SET NULL,
  INDEX `idx_status` (`status`),
  INDEX `idx_category` (`category`),
  INDEX `idx_barber_id` (`barber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TESTIMONIALS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `customer_name` VARCHAR(100) NOT NULL,
  `customer_email` VARCHAR(100),
  `customer_photo` VARCHAR(255),
  `service_id` INT,
  `barber_id` INT,
  `rating` INT CHECK (rating >= 1 AND rating <= 5),
  `comment` TEXT NOT NULL,
  `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`barber_id`) REFERENCES `barbers`(`id`) ON DELETE SET NULL,
  INDEX `idx_status` (`status`),
  INDEX `idx_rating` (`rating`),
  INDEX `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- BLOGS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `admin_id` INT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `content` LONGTEXT NOT NULL,
  `excerpt` VARCHAR(500),
  `featured_image` VARCHAR(255),
  `category` VARCHAR(100),
  `tags` VARCHAR(500),
  `views` INT DEFAULT 0,
  `status` ENUM('draft', 'published') DEFAULT 'draft',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`admin_id`) REFERENCES `admins`(`id`) ON DELETE SET NULL,
  INDEX `idx_status` (`status`),
  INDEX `idx_slug` (`slug`),
  INDEX `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- CONTACTS TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20),
  `subject` VARCHAR(200),
  `message` TEXT NOT NULL,
  `status` ENUM('new', 'read', 'replied') DEFAULT 'new',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_status` (`status`),
  INDEX `idx_email` (`email`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- FAQ TABLE
-- =====================================================
CREATE TABLE IF NOT EXISTS `faq` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(500) NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(100),
  `order` INT DEFAULT 0,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_status` (`status`),
  INDEX `idx_category` (`category`),
  INDEX `idx_order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SAMPLE DATA
-- =====================================================

-- Admin User (Password: admin123)
INSERT INTO `admins` (`username`, `email`, `password`, `full_name`, `phone`, `role`, `status`) VALUES
('admin', 'admin@barbershop.com', '$2y$10$E8rkziAVez0WcN76nY.diOiYbi1sSHubDV9Z7B.1B3u9B9VqW9Hha', 'Admin User', '+1-555-0100', 'super_admin', 'active');

-- Services
INSERT INTO `services` (`name`, `description`, `price`, `duration`, `image`, `category`, `status`) VALUES
('Haircut', 'Classic professional haircut with styling', 25.00, 30, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Skin Fade', 'Modern skin fade with precision blending', 35.00, 45, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Buzz Cut', 'Clean and simple buzz cut', 15.00, 20, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Kids Haircut', 'Haircut service for children', 20.00, 25, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Hair Wash', 'Premium hair wash with head massage', 10.00, 15, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Hair Coloring', 'Professional hair coloring service', 50.00, 60, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Hair', 'active'),
('Beard Trim', 'Professional beard trimming and shaping', 20.00, 25, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Beard', 'active'),
('Beard Styling', 'Complete beard styling and grooming', 30.00, 40, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Beard', 'active'),
('Facial', 'Relaxing facial treatment', 40.00, 50, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Facial', 'active'),
('Head Massage', 'Therapeutic head and neck massage', 25.00, 30, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Massage', 'active'),
('VIP Package', 'Complete luxury grooming package', 100.00, 120, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Premium', 'active');

-- Barbers
INSERT INTO `barbers` (`first_name`, `last_name`, `email`, `phone`, `photo`, `experience_years`, `specialization`, `bio`, `rating`, `total_reviews`, `facebook`, `instagram`, `twitter`, `status`) VALUES
('Marcus', 'Johnson', 'marcus@barbershop.com', '+1-555-0101', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500', 12, 'Fade & Styling', 'Expert in modern fade techniques and custom styling', 4.9, 156, 'https://facebook.com/marcus', 'https://instagram.com/marcus', 'https://twitter.com/marcus', 'active'),
('David', 'Miller', 'david@barbershop.com', '+1-555-0102', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500', 8, 'Classic Cuts', 'Traditional barber with modern techniques', 4.8, 124, 'https://facebook.com/david', 'https://instagram.com/david', 'https://twitter.com/david', 'active'),
('James', 'Wilson', 'james@barbershop.com', '+1-555-0103', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500', 15, 'Beard Specialist', 'Master of beard grooming and facial treatments', 5.0, 98, 'https://facebook.com/james', 'https://instagram.com/james', 'https://twitter.com/james', 'active'),
('Christopher', 'Davis', 'chris@barbershop.com', '+1-555-0104', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500', 10, 'Color & Design', 'Creative hair coloring and design specialist', 4.7, 87, 'https://facebook.com/chris', 'https://instagram.com/chris', 'https://twitter.com/chris', 'active');

-- FAQ
INSERT INTO `faq` (`question`, `answer`, `category`, `order`, `status`) VALUES
('How do I book an appointment?', 'You can easily book an appointment through our website by selecting your preferred service, barber, date, and time. Fill in your contact information and submit the form.', 'Booking', 1, 'active'),
('Can I cancel or reschedule my appointment?', 'Yes, you can cancel or reschedule your appointment up to 24 hours before your scheduled time by contacting us via phone or email.', 'Booking', 2, 'active'),
('Do you accept walk-ins?', 'We welcome walk-ins, but appointments are recommended to avoid waiting times. Walk-ins are served on a first-come, first-served basis.', 'General', 3, 'active'),
('What payment methods do you accept?', 'We accept cash, credit cards, debit cards, and digital payment methods including PayPal and Apple Pay.', 'Payment', 4, 'active'),
('Are there discounts available?', 'Yes! We offer discounts for first-time customers, group bookings, and loyalty program members. Ask our staff for details.', 'Pricing', 5, 'active'),
('How long do services typically take?', 'Service duration varies. A basic haircut takes about 30 minutes, while specialty services like coloring may take up to 60 minutes.', 'Services', 6, 'active');

-- Gallery Images
INSERT INTO `gallery` (`barber_id`, `image_path`, `title`, `description`, `category`, `status`) VALUES
(1, 'https://images.unsplash.com/photo-1585747860715-cd4628902c4a?w=500', 'Modern Fade', 'Clean skin fade with precision lines', 'Fades', 'active'),
(1, 'https://images.unsplash.com/photo-1599351935271-bf5c1a28a6ee?w=500', 'Classic Fade', 'Classic fade with textured top', 'Fades', 'active'),
(2, 'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=500', 'Buzz Cut', 'Clean buzz cut style', 'Hair', 'active'),
(3, 'https://images.unsplash.com/photo-1535956636122-b8521e97a3d2?w=500', 'Beard Style', 'Professional beard grooming', 'Beard', 'active'),
(4, 'https://images.unsplash.com/photo-1559311514-7a38c79c34b8?w=500', 'Hair Color', 'Creative hair coloring', 'Color', 'active');

-- Sample Testimonials
INSERT INTO `testimonials` (`customer_name`, `customer_email`, `customer_photo`, `barber_id`, `rating`, `comment`, `status`) VALUES
('John Smith', 'john@example.com', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200', 1, 5, 'Amazing experience! Marcus did an excellent job on my haircut. Highly recommended!', 'approved'),
('Michael Brown', 'michael@example.com', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200', 2, 5, 'Professional service and friendly staff. Will definitely come back!', 'approved'),
('Robert Johnson', 'robert@example.com', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=200', 3, 5, 'Best beard trim I have ever had. James knows his stuff!', 'approved');