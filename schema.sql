-- Database Schema for Training Management System

CREATE DATABASE IF NOT EXISTS training_db;
USE training_db;

-- 1. Classification Table
CREATE TABLE IF NOT EXISTS classifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Training Table
CREATE TABLE IF NOT EXISTS trainings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    classification_id INT,
    price DECIMAL(10, 2) NOT NULL,
    instructor VARCHAR(255),
    schedule TEXT,
    deadline DATETIME NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (classification_id) REFERENCES classifications(id) ON DELETE SET NULL
);

-- 3. Offer Table
CREATE TABLE IF NOT EXISTS offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    training_id INT,
    discount_type ENUM('percentage', 'fixed') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (training_id) REFERENCES trainings(id) ON DELETE CASCADE
);

-- 4. Registration Table
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    training_id INT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (training_id) REFERENCES trainings(id) ON DELETE CASCADE
);

-- 5. Admin Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy data for testing
INSERT INTO classifications (name, description) VALUES ('Web Development', 'Modern web technologies'), ('Digital Marketing', 'Marketing strategies');

INSERT INTO trainings (title, description, classification_id, price, instructor, schedule, deadline) 
VALUES ('Full-Stack PHP', 'Learn PHP and MySQL', 1, 5000.00, 'John Doe', 'Mon/Wed 7-9 PM', '2026-04-01 00:00:00');

INSERT INTO offers (training_id, discount_type, discount_value, start_date, end_date)
VALUES (1, 'percentage', 20.00, '2026-03-01 00:00:00', '2026-03-31 23:59:59');
