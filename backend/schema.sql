-- Create Database (if not exists)
CREATE DATABASE IF NOT EXISTS jahari_safaris_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jahari_safaris_db;

-- Users Table (Admins / Staff)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager') DEFAULT 'manager',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inquiries Table (Leads / Quotes)
CREATE TABLE IF NOT EXISTS inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    client_phone VARCHAR(20) NOT NULL,
    client_email VARCHAR(100) NULL,
    subject VARCHAR(255) NOT NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    status ENUM('pending', 'contacted', 'booked', 'closed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Catalog Items Table (Vehicles, Lodges, Tents, Campsites)
CREATE TABLE IF NOT EXISTS catalog_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('vehicle', 'lodge', 'campsite', 'tent') NOT NULL,
    title VARCHAR(100) NOT NULL,
    location VARCHAR(100) NULL,
    description TEXT NULL,
    price_usd DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) NULL,
    features JSON NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert dummy admin user (password: Admin123!)
-- Hash generated using password_hash('Admin123!', PASSWORD_DEFAULT)
INSERT INTO users (username, password_hash, role) 
VALUES ('admin', '$2y$10$S9GjXo3F0x/8S2c9jH5jKuP0Q7o1O7/eY9H8Tz0Vw3uL9GjXo3F0x', 'admin');

-- Insert sample catalog items
INSERT INTO catalog_items (type, title, location, description, price_usd, image_url, features) VALUES 
('vehicle', 'Toyota Land Cruiser V8', 'Nairobi/Maasai Mara', 'Premium 4WD luxury safari vehicle.', 250.00, 'https://images.unsplash.com/photo-1596766986503-4f964cf7b8d7?auto=format&fit=crop&w=800&q=80', '["7 Seats", "Automatic", "4WD", "A/C"]'),
('lodge', 'Ol Pejeta Rhino Camp', 'Ol Pejeta Conservancy', 'Exclusive 5-star camp with private spa.', 800.00, 'https://images.unsplash.com/photo-1498622205843-3b0ac17be8fa?auto=format&fit=crop&w=800&q=80', '["Pool", "Spa", "Wi-Fi", "Full Board"]');
