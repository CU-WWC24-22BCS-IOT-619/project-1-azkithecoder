<?php
// index.php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Saver - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Track & Optimize Your Energy Usage
                </h1>
                <p class="text-xl mb-8">
                    Monitor your electricity consumption, calculate bills, and discover ways to save money on your energy costs.
                </p>
                <?php if (!isLoggedIn()): ?>
                    <div class="space-x-4">
                        <a href="register.php" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50">
                            Get Started
                        </a>
                        <a href="login.php" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
                            Login
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Key Features</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-4">Bill Calculator</h3>
                    <p class="text-gray-600">
                        Calculate your electricity bills accurately using current Indian electricity rates and slabs.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">📈</div>
                    <h3 class="text-xl font-semibold mb-4">Usage Tracking</h3>
                    <p class="text-gray-600">
                        Monitor your monthly consumption patterns and track your spending over time.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">💡</div>
                    <h3 class="text-xl font-semibold mb-4">Energy Saving Tips</h3>
                    <p class="text-gray-600">
                        Get personalized recommendations to reduce your energy consumption and save money.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>

            <div class="max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row items-center mb-8 space-y-4 md:space-y-0 md:space-x-8">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">1</div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Create an Account</h3>
                        <p class="text-gray-600">Sign up for free and start tracking your energy consumption.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center mb-8 space-y-4 md:space-y-0 md:space-x-8">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">2</div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Enter Your Usage</h3>
                        <p class="text-gray-600">Input your monthly electricity consumption in units.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">3</div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Get Insights</h3>
                        <p class="text-gray-600">View your bill calculations and receive personalized saving tips.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>