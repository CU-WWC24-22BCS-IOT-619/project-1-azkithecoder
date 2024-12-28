<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'energy_calculator');

// Indian electricity slab rates (in Rs. per unit)
define('SLAB_RATES', [
    '0-100' => 3.50,
    '101-300' => 4.50,
    '301-500' => 6.50,
    '501+' => 8.00
]);

// Fixed charges
define('FIXED_CHARGE', 50); // Basic fixed charge
define('TAX_RATE', 0.05); // 5% tax

// Database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}