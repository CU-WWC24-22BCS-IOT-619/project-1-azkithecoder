<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer at Bottom</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <style>
        /* Ensure the footer stays at the bottom without unnecessary space */
        html, body {
            height: 100%;
            margin: 0;
        }
        #page-container {
            display: flex;
            flex-direction: column;
            min-height: 0px;
        }
        #content {
            flex: 1;
        }
    </style>
</head>
<body>
    <div id="page-container">
        
        <footer class="bg-gray-800 text-white">
            <div class="container mx-auto px-4 py-6">
                <div class="text-center">
                    <p>&copy; <?php echo date('Y'); ?> Energy Saver. All rights reserved.</p>
                    <div class="mt-2">
                        <a href="#" class="hover:text-blue-300">Privacy Policy</a>
                        <span class="mx-2">|</span>
                        <a href="#" class="hover:text-blue-300">Terms of Service</a>
                        <span class="mx-2">|</span>
                        <a href="#" class="hover:text-blue-300">Contact Us</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
