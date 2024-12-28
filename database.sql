CREATE DATABASE energy_calculator;
USE energy_calculator;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE consumption_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    units_consumed DECIMAL(10,2) NOT NULL,
    bill_amount DECIMAL(10,2) NOT NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE energy_tips (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    potential_savings INT NOT NULL
);

-- Insert some sample energy saving tips
INSERT INTO energy_tips (title, description, potential_savings) VALUES
('Use LED Bulbs', 'Replace all traditional bulbs with LED alternatives. LED bulbs use 75% less energy and last 25 times longer.', 15),
('Optimize AC Temperature', 'Set AC temperature to 24°C for optimal efficiency. Each degree lower increases consumption by 6%.', 20),
('Regular Appliance Maintenance', 'Clean AC filters and service appliances regularly for maximum efficiency.', 10),
('Use Natural Light', 'Make maximum use of natural light during daytime. Keep windows clean and curtains open.', 5),
('Full Load Laundry', 'Run washing machine only with full loads to maximize efficiency.', 8);