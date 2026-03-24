-- Create Database
CREATE DATABASE IF NOT EXISTS crud_db;
USE crud_db;

-- Create Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    age INT NOT NULL
);

-- Insert Sample Data
INSERT INTO users (name, email, age) VALUES
('John Doe', 'john@example.com', 25),
('Jane Smith', 'jane@example.com', 30),
('Alice Brown', 'alice@example.com', 22),
('Bob Johnson', 'bob@example.com', 28),
('Rahul Sharma', 'rahul.sharma@example.com', 24),
('Priya Verma', 'priya.verma@example.com', 27),
('Amit Kumar', 'amit.kumar@example.com', 29),
('Neha Gupta', 'neha.gupta@example.com', 23),
('Vikas Singh', 'vikas.singh@example.com', 31),
('Sneha Patel', 'sneha.patel@example.com', 26),
('Rohit Mehta', 'rohit.mehta@example.com', 28),
('Anjali Desai', 'anjali.desai@example.com', 22),
('Karan Malhotra', 'karan.malhotra@example.com', 30),
('Pooja Kapoor', 'pooja.kapoor@example.com', 25);