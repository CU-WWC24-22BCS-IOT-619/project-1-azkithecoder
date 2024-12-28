<?php
?>
<!--- Header File --->
<header class="bg-blue-600 text-white shadow-lg">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold">Energy Saver</a>
            
            <div class="space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="calculator.php" class="hover:text-blue-200">Calculator</a>
                    <a href="history.php" class="hover:text-blue-200">History</a>
                    <a href="tips.php" class="hover:text-blue-200">Tips</a>
                    <span class="px-2">|</span>
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-blue-200">Login</a>
                    <a href="register.php" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>