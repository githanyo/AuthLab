-- ============================================
-- AuthLab Database Setup
-- ============================================

-- Create Database
CREATE DATABASE IF NOT EXISTS authlab;
USE authlab;

-- ============================================
-- Users Table
-- ============================================

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- Seed Data (VULNERABLE VERSION - PLAINTEXT)
-- ============================================

INSERT INTO users (username, password, role) VALUES
('user1', 'password123', 'user'),
('user2', 'password123', 'user'),
('admin', 'admin123', 'admin');

-- ============================================
-- OPTIONAL: SECURE VERSION PASSWORDS
-- Uncomment below after switching to password_hash()
-- ============================================

/*
-- Example hashed passwords (generated using PHP password_hash)

TRUNCATE TABLE users;

INSERT INTO users (username, password, role) VALUES
('user1', '$2y$10$wH8QzQ8vQ0Jp0Yk9lF3Z2u7r9uRk8KX1zRzqJ6l6Zz8wq9W1k8a2K', 'user'),
('user2', '$2y$10$wH8QzQ8vQ0Jp0Yk9lF3Z2u7r9uRk8KX1zRzqJ6l6Zz8wq9W1k8a2K', 'user'),
('admin', '$2y$10$k9PzQ8vQ0Jp0Yk9lF3Z2u7r9uRk8KX1zRzqJ6l6Zz8wq9W1k8b3M', 'admin');
*/

-- ============================================
-- Notes
-- ============================================

-- Default Credentials (Vulnerable Version):
-- user1 / password123
-- user2 / password123
-- admin / admin123

-- For Secure Version:
-- Generate hashes using:
-- password_hash('password123', PASSWORD_DEFAULT);
